<?php

class CheltuielisController extends BaseController {
        protected $layout = 'layout';
        
        public function __construct() {
            View::share('active_link', 'Cheltuieli');
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
            //Session::forget('asociatie_id');
            $asociatie_id = getInputOrSession('asociatie_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
            $cheltuieli = $asociatie_id!='0' ? Cheltuieli::where('asociatie_id', '=', $asociatie_id)->get(): array();
            $this->layout->content = View::make('cheltuielis.index')
			->with('cheltuieli', $cheltuieli);
			//->with('asociatie_id', $asociatie_id);
            //return View::make('cheltuielis.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $this->layout->content = View::make('cheltuielis.create');
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
		//	'asociatie_id' => 'required|exists:asociatie,id'
		//));
		//if($validator->fails()) return Redirect::action('BlocsController@create')->with('flash_error', $validator->messages());
		$cheltuieli = new Cheltuieli();
		$cheltuieli->fill($input);
                $luna = date_format(new Datetime(getInputOrSession('luna')), 'Y-m-d');
                $cheltuieli->luna = $luna;
		$cheltuieli->save();
                               
		return Redirect::action('CheltuielisController@index')->with('flash_success', "Cheltuiala  a fost salvata.");
                
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            return View::make('cheltuielis.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            if(!Cheltuieli::find($id)) {
		return Redirect::action('CheltuielisController@index');
            }
            $this->layout->content = View::make('cheltuielis.create')
		->with('cheltuieli', Cheltuieli::find($id));
            		
            //return View::make('cheltuielis.create');
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
		$cheltuieli = Cheltuieli::find($id);
		$cheltuieli->fill($input);
                
                $luna = date_format(new Datetime(getInputOrSession('luna')), 'Y-m-d');
                $cheltuieli->luna = $luna;
                //var_dump($luna);
                //die();
		$cheltuieli->save();
              
		return Redirect::action('CheltuielisController@index')
			->with('flash_info', "Cheltuieli salvate.");
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
