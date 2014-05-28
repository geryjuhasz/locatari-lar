<?php

class Cost_locatarisController extends BaseController {
        protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            $calcul = $asociatie_id!='0' ? Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)->get(): Calcul_asociatie::all();;
            $luna = getInputOrSession('luna');

            //
            //calculateRepartition($asociatie_id, $luna);
            
            
            //populare Cost_locatari
            $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->get();
            //var_dump($cheltuieli);
            //die();
            
            
            //die();    
            $this->layout->content = View::make('cost_locataris.index')
			->with('calcul', $calcul)
			->with('asociatie_id', $asociatie_id);
            return View::make('cost_locataris.index');
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
            calculateRepartition($asociatie_id, $luna);
            return Redirect::action('Cost_locatarisController@index')->with('flash_success', "Reparitita a fost calculata.");
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
            $luna = getInputOrSession('luna');
            calculateRepartition($asociatie_id, $luna);
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
