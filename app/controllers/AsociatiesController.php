<?php

class AsociatiesController extends BaseController {
         protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            return View::make('asociaties.index')->with('asociatie', Asociatie::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $this->layout->content = View::make('asociaties.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validator = Validator::make($input, array(
			'denumire' => 'required',
			'administrator' => 'required'
		));
		if($validator->fails()) return Redirect::action('AsociatiesController@create')->with('flash_error', $validator->messages());
		$asociatie = new Asociatie();
		$asociatie->fill($input);
		$asociatie->save();
		
		return Redirect::action('AsociatiesController@index')->with('flash_success', "Asociatia '$asociatie->denumire' a fost creata.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('asociaties.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!Bloc::find($id)) {
			return Redirect::action('AsociatiesController@index');
		}
		$this->layout->content = View::make('asociaties.create')
			->with('asociatie', Asociatie::find($id));
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
                Asociatie::find($id)->delete();
		return Redirect::action('AsociatiesController@index')->with('flash_warning', "Asociatia a fost stearsa.");
	}

       
}
