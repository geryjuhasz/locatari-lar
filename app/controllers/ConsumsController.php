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
            //Session::flush();
            if(Input::get('scara_id')) {
		$scara_id = Input::get('scara_id');
		Session::put('scara_id', $scara_id);
            } else if(Session::get('scara_id')) {
		$scara_id = Session::get('scara_id');
            } else {
		$scara_id = '0';
            }
            
            if(Input::get('luna')) {
		$luna = Input::get('luna');
		Session::put('luna', $luna);
            } else if(Session::get('luna')) {
		$luna = Session::get('luna');
            } else {
		$luna = '0';
            }
            
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
            //$consum = $asociatie_id!='0' ? Consum::where('asociatie_id', '=', $asociatie_id)->get(): array();
            if ($scara_id != 0) $locatari = Scara::find($scara_id)->locatari;
            else $locatari = Locatari::all();
            
            $query = Locatari::query()->leftjoin('consum', 'consum.locatari_id', '=', 'locatari.id');
            $query = $query->leftjoin('scara', 'scara.id', '=', 'locatari.scara_id');
            $query = $query->where('scara.id', '=', $scara_id);
            //$query = $query->where('consum.luna', '=', '2014-01-01');
            $query = $query->select('locatari.nume', 'locatari.nr_apartament', 'consum.tipincapere_id', 'consum.index_vechi', 'consum.index_nou');
            $consum = $query->get();
            $this->layout->content = View::make('consums.index')
			->with('consum', $consum)
			->with('luna', $luna);
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
