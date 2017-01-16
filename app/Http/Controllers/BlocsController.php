<?php

class BlocsController extends Controller {
    protected $layout = 'layout';
        
    public function __construct() {
            View::share('active_link', 'Asociatii');
            $admin = $this->admin = Auth::user();
            $this->beforeFilter(function() use($admin) {
                if($admin->type !== 'super') {
//                    return Redirect::action('AdminsController@login')->with('flash_warning', 'Permission denied.');
                }
            });
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    	$asociatie_id = getInputOrSession('asociatie_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
        $bloc = $asociatie_id!='0' ? Bloc::where('asociatie_id', '=', $asociatie_id)->get(): Bloc::all();
        return View::make('blocs.index')
			->with('bloc', $bloc)
			->with('asociatie_id', $asociatie_id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('blocs.create');
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
			'asociatie_id' => 'required|exists:asociatie,id'
		));
		if($validator->fails()) return Redirect::action('BlocsController@create')->with('flash_error', $validator->messages());
		$bloc = new Bloc();
		$bloc->fill($input);
		$bloc->save();
		
		return Redirect::action('BlocsController@index')->with('flash_success', "Blocul '$bloc->denumire' a fost adaugat.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('blocs.show');
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
			return Redirect::action('BlocsController@index');
		}
		return View::make('blocs.create')
			->with('bloc', Bloc::find($id));
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
		$bloc = Bloc::find($id);
		$bloc->fill($input);
		$bloc->save();
		return Redirect::action('BlocsController@index')
			->with('flash_info', "Blocul '$bloc->denumire' salvat.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
                Bloc::find($id)->delete();
		return Redirect::action('BlocsController@index')->with('flash_warning', "Blocul a fost sters.");
	}

}
