<?php

class LocatarisController extends BaseController {
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
            $scara_id = getInputOrSession('scara_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
            $locatari = $scara_id!='0' ? Locatari::where('scara_id', '=', $scara_id)->get(): Locatari::all();

            $this->layout->content = View::make('locataris.index')
			->with('locatari', $locatari)
			->with('scara_id', $scara_id);

            //return View::make('locataris.index')->with('locatari', Locatari::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $this->layout->content = View::make('locataris.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		//$validator = Validator::make($input, array(
		//	'denumire' => 'required',
		//));
		//if($validator->fails()) return Redirect::action('ScarasController@create')->with('flash_error', $validator->messages());
		$locatari = new Locatari();
		$locatari->fill($input);
		$locatari->save();
		
		return Redirect::action('LocatarisController@index')->with('flash_success', "Locatarul '$locatari->nume' a fost adaugat.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('locataris.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            if(!Locatari::find($id)) {
			return Redirect::action('LocatarisController@index');
		}
		$this->layout->content = View::make('locataris.create')
			->with('locatari', Locatari::find($id));
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
		$locatari = Locatari::find($id);
		$locatari->fill($input);
		$locatari->save();
		return Redirect::action('LocatarisController@index')
			->with('flash_info', "Locatarul '$locatari->nume' a fost salvat.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Locatari::find($id)->delete();
		return Redirect::action('LocatarisController@index')->with('flash_warning', "Locatarul a fost sters.");
	}

}
