<?php

class ConsumsController extends BaseController {
        protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            $asociatie = Asociatie::Find($asociatie_id); 
            $scara_id = getInputOrSession('scara_id');
            $luna = Session::get('luna');
            $tipconsum_id = getInputOrSession('tipconsum_id');
            
            if ($scara_id != 0) $locatari = Scara::find($scara_id)->locatari;
            else $locatari = Locatari::all();
            $consum['Locatari'] = $locatari;
     
            
            
            //get locatari data without consum
//            $query = Locatari::query()->leftjoin('scara', 'scara.id', '=', 'locatari.scara_id');
//            $query = $query->where('scara.id', '=', $scara_id);
//            $query = $query->select('locatari.nume', 'locatari.nr_apartament');
//            $consum['Locatari'] = $locatari;

            //die();
            //$a = Asociatie_consum::find($asociatie_id);

            $asociatie_consum = Asociatie_consum::where('asociatie_id', '=', $asociatie_id)
                ->where('tipconsum_id', '=',$tipconsum_id )
            ->get();
            
            $consum['Consum'] = null;
            foreach ($asociatie_consum as $aconsum) {
                $query = Locatari::query()->leftjoin('scara', 'scara.id', '=', 'locatari.scara_id');
                $query = $query->where('scara.id', '=', $scara_id);

                $query = $query->leftjoin('consum', 'consum.locatari_id', '=', 'locatari.id');
                $query = $query->where('consum.luna', '=', '2014-01-01');
                $query = $query->where('consum.tipconsum_id', '=', $tipconsum_id);
                $query = $query->where('consum.tipincapere_id', '=', $aconsum->tipincapere->id);
                $query = $query->select('locatari.nume', 'locatari.nr_apartament', 'consum.index_vechi_rece', 'consum.index_nou_rece', 'consum.index_vechi_calda', 'consum.index_nou_calda');
                $cons['Name']=$aconsum->tipincapere->denumire;
                $cons['Consum'] = $query->get();
                $consum['Consum'][] = $cons;
            }
            
            //$a = $consum['Consum'][0]['Consum'][0];
            //var_dump($a);die();
            //foreach($a as $b)
            //{
            //   var_dump($b->nr_incapere);die();
            //}
            //$query = $queryconsum;
            $this->layout->content = View::make('consums.index')
			->with('consum', $consum)
			->with('luna', $luna)
                        ->with('asociatie', $asociatie);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('consums.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('consums.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('consums.edit');
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
