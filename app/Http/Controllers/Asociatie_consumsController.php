<?php

class Asociatie_consumsController extends Controller {
        
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('asociatie_consums.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $asociatie_id = getInputOrSession('asociatie_id');
        return View::make('asociatie_consums.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$asociatie_consum = new Asociatie_consum();
		$asociatie_consum->fill($input);
                
		$asociatie_consum->save();
		
		return Redirect::action('Calcul_asociatiesController@index')->with('flash_success', "Calcul salvat.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('asociatie_consums.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$asociatie_id = getInputOrSession('asociatie_id');
        return View::make('asociatie_consums.create')
			->with('consumasociatie', Asociatie_consum::find($asociatie_id));
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
		Asociatie_consum::find($id)->delete();
		return Redirect::action('Calcul_asociatiesController@index')->with('flash_warning', "Contor sters.");
	}

}
