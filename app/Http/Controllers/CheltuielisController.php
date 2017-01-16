<?php

class CheltuielisController extends Controller {
    //protected $layout = 'layout';
        
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
	    $asociatie_id = getInputOrSession('asociatie_id');
        View::share('asociatie_id', $asociatie_id);
	    
	    $cheltuieli = $asociatie_id!='0' ? Cheltuieli::FromAsociatie($asociatie_id)
	    		->orderBy('luna', 'desc')
	    		->get(): array();
	    		
	    return View::make('cheltuielis.index')
			->with('cheltuieli', $cheltuieli);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$asociatie_id = getInputOrSession('asociatie_id');
        View::share('asociatie_id', $asociatie_id);

		$tipcheltuieli  = Tipcheltuieli::lists('denumire', 'id');
	   	View::share('tipcheltuieli', $tipcheltuieli);

        $tipcheltuieli_id  = getInputOrSession('tipcheltuieli_id');
	   	View::share('tipcheltuieli_id', $tipcheltuieli_id);

        $furnizori  = Furnizori::all();
	   	View::share('furnizori', $furnizori);
		
		$furnizor_id = getInputOrSession('furnizor_id');
		View::share('furnizor_id', $furnizor_id);

		$tipdocument  = Tipdocument::all();
	   	View::share('tipdocument', $tipdocument);
        
        $tipdocument_id = getInputOrSession('tipdocument_id');
		View::share('tipdocument_id', $tipdocument_id);

        $tiprepartitie  = Tiprepartitie::all();
	   	View::share('tiprepartitie', $tiprepartitie);
        return View::make('cheltuielis.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$asociatie_id = getInputOrSession('asociatie_id');
		//$validator = Validator::make($input, array(
		//	'denumire' => 'required',
		//	'asociatie_id' => 'required|exists:asociatie,id'
		//));
		//if($validator->fails()) return Redirect::action('BlocsController@create')->with('flash_error', $validator->messages());
		$cheltuieli = new Cheltuieli();
		$cheltuieli->fill($input);
		//var_dump($input);exit;
        $luna = date_format(new Datetime(Session::get('luna')), 'Y-m-d');
        $cheltuieli->luna = $luna;
        $cheltuieli->asociatie_id = $asociatie_id;
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
		$cheltuieli = Cheltuieli::find($id);
        if(!$cheltuieli) {
			return Redirect::action('CheltuielisController@index');
        }

        $tipcheltuieli  = Tipcheltuieli::lists('denumire', 'id');
	   	View::share('tipcheltuieli', $tipcheltuieli);

	   	$tipdocument  = Tipdocument::all();
	   	View::share('tipdocument', $tipdocument);
		
		$tipdocument_id = $cheltuieli->tipdocument_id;
		View::share('tipdocument_id', $tipdocument_id);
	   	
	   	$furnizori  = Furnizori::all();
	   	View::share('furnizori', $furnizori);
		
		$furnizor_id = $cheltuieli->furnizor_id;
		View::share('furnizor_id', $furnizor_id);

		$tiprepartitie  = Tiprepartitie::all();
	   	View::share('tiprepartitie', $tiprepartitie);

        return View::make('cheltuielis.create')
			->with('cheltuieli', $cheltuieli);
            		
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
		Cheltuieli::find($id)->delete();
		return Redirect::action('CheltuielisController@index')->with('flash_warning', "Cheltuiala a fost stearsa.");
	}

}
