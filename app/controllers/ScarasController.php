<?php

class ScarasController extends BaseController {
        protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $bloc_id = getInputOrSession('bloc_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
            $scara = $bloc_id!='0' ? Scara::where('bloc_id', '=', $bloc_id)->get(): Scara::all();

            $this->layout->content = View::make('scaras.index')
			->with('scara', $scara)
			->with('bloc_id', $bloc_id);

            //return View::make('scaras.index')->with('scara', Scara::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $this->layout->content = View::make('scaras.create');
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
			'bloc_id' => 'required|exists:bloc,id',
                        'total_mp' => 'required',
                        'total_apartamente' => 'required'
		));
		if($validator->fails()) return Redirect::action('ScarasController@create')->with('flash_error', $validator->messages());
		$scara = new Scara();
		$scara->fill($input);
		$scara->save();
		
		return Redirect::action('ScarasController@index')->with('flash_success', "Scara '$scara->denumire' a fost adaugata.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('scaras.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            if(!Scara::find($id)) {
			return Redirect::action('ScarasController@index');
		}
		$this->layout->content = View::make('scaras.create')
			->with('scara', Scara::find($id));
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
		//$validator = Validator::make($input, array(
		//	'denumire' => 'required'
		//));
		//if($validator->fails()) return Redirect::action('BlocsController@edit')->with('flash_error', $validator->messages());
		$scara = Scara::find($id);
		$scara->fill($input);
		$scara->save();
		return Redirect::action('ScarasController@index')
			->with('flash_info', "Scara '$scara->denumire' a fost salvata.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Scara::find($id)->delete();
		return Redirect::action('ScarasController@index')->with('flash_warning', "Scara a fost stearsa.");
	}

}
