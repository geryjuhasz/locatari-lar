<?php

class AsociatiesController extends Controller {
        protected $layout = 'layout';
         
        public function __construct() {
            View::share('active_link', 'Asociatii');
            $admin = $this->admin = Auth::user();
            $this->beforeFilter(function() use($admin) {
                if($admin->type !== 'super') {
                    return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
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
            Session::forget('asociatie_id');
            return View::make('asociaties.index')->with('asociatie', Asociatie::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('asociaties.create');
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
            if(!Asociatie::find($id)) {
                return Redirect::action('AsociatiesController@index');
            }
            return View::make('asociaties.create')
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
		$input = Input::all();
                $asociatie = Asociatie::find($id);
                $asociatie->fill($input);
                //$asociatie->consum_apa = empty($input['consum_apa'])? false: true;
                //$asociatie->consum_caldura = empty($input['consum_caldura'])? false: true;
		$asociatie->save();
		
		//return Redirect::action('Calcul_asociatiesController@index')->with('asociatie_id', $id);
                //return Redirect::action('Calcul_asociatiesController@index')->with('flash_info', 'Setari salvate.');
                return Redirect::action('AsociatiesController@index')->with('flash_info', 'Setari salvate.');

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
