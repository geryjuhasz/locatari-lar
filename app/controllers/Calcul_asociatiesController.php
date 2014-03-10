<?php

class Calcul_asociatiesController extends BaseController {
        protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('calcul_asociaties.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('calcul_asociaties.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$calculasociatie = new Calcul_asociatie();
		$calculasociatie->fill($input);
                
		$calculasociatie->save();
		
		return Redirect::action('AsociatiesController@index')->with('flash_success', "Calcul salvat.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('calcul_asociaties.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($asociatie_id)
	{
            //if(!Calcul_asociatie::find($asociatie_id)) {
		//	return Redirect::action('AsociatiesController@edit');
		//}
		$this->layout->content = View::make('calcul_asociaties.create')
			->with('calculasociatie', Calcul_asociatie::find($asociatie_id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$calculasociatie = new Calcul_asociatie();
		$calculasociatie->fill($input);
                
		$calculasociatie->save();
		
		return Redirect::action('AsociatiesController@index')->with('flash_success', "Calcul salvat.");
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
