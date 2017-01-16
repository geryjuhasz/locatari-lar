<?php

class Cost_locatarisController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $asociatie_id = Session::get('asociatie_id');
            //$calcul = $asociatie_id!='0' ? Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)->get(): Calcul_asociatie::all();;
            //$luna = getDateInputOrSession('luna');
            $luna = date_format(new Datetime(getInputOrSession('luna')), 'Y-m-d');
            //var_dump($luna);exit;
            
            //calculateRepartition($asociatie_id, $luna);
            //calculateCostLocatari($asociatie_id, $luna);
            //die();
            $scari = array();
            $scari = Scara::FromAsociatie($asociatie_id)->get();
            
            $costuri_salvate = array();  
            //var_dump($costuri_salvate);die();
            foreach ($scari as $scara){
                $costuri_salvate[$scara->id]['scara'] = $scara->denumire;
                $costuri_scara = array();
                $costuri_scara = Cost_locatari::FromScara($scara->id)
                        ->where('luna', '=', $luna)
                        ->get();
                $costuri_salvate[$scara->id]['cost'] = $costuri_scara;
            }
//            $costuri_salvate = Cost_locatari::FromAsociatie($asociatie_id)
//                        ->where('luna', '=', $luna)
//                        ->get();
//            
            return View::make('cost_locataris.index')
			->with('costuri', $costuri_salvate)
			->with('asociatie_id', $asociatie_id);
            //return View::make('cost_locataris.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('cost_locataris.create');
	}

    public function calculate()
	{
            //return View::make('cost_locataris.index');
	}
        
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            //$luna = getInputOrSession('luna');
            $luna = date_format(new Datetime(getInputOrSession('luna')), 'Y-m-d');

            calculateRepartition($asociatie_id, $luna);
            //exit;
            //calculateCostLocatari($asociatie_id, $luna);
            
            return Redirect::action('Cost_locatarisController@index')->with('flash_success', "Reparitita a fost calculata.");
            
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('cost_locataris.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('cost_locataris.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

        
        
}
