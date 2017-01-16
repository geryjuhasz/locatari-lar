<?php 

class LocatarContor extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locatari_id = getInputOrSession('locatari_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
        $contoare = $locatari_id!='0' ? Locatari_contor::where('locatari_id', '=', $locatari_id)->get(): null;
        return View::make('locatarcontor.index')
        	->with('contoare', $contoare)
			->with('locatari_id', $locatari_id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$locatari_id = getInputOrSession('locatari_id');
		$tipcontor = Tipcontor::lists('denumire', 'id');
		return View::make('locatarcontor.create')
			->with('tipcontor', $tipcontor)
			->with('locatari_id', $locatari_id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$locatari_id = getInputOrSession('locatari_id');
		$input = Input::all();
		
		$locatarcontor = new Locatari_contor();
		$locatarcontor->fill($input);
		$locatarcontor->save();
		return Redirect::action('LocatarContor@index', array('locatari_id' => $locatari_id))
			->with('flash_success', "Contorul a fost adaugat.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($locatar_id)
	{
		//
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		$locatari_id = getInputOrSession('locatari_id');
		Locatari_contor::find($id)->delete();
		return Redirect::action('LocatarContor@index', array('locatari_id' => $locatari_id))
			->with('flash_success', "Contorul a fost adaugat.");
		
	}

}
