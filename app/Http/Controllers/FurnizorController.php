<?php 

class FurnizorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$asociatie_id = getInputOrSession('asociatie_id');
        $furnizori = $asociatie_id!='0' ? Furnizori::FromAsociatie($asociatie_id)->get() : null;

        return View::make('furnizori.index')
			->with('furnizori', $furnizori);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('furnizori.create');
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
		$furnizor = new Furnizori();
		$furnizor->fill($input);
        //$luna = date_format(new Datetime(Session::get('luna')), 'Y-m-d');
        $furnizor->asociatie_id = $asociatie_id;
        $furnizor->save();
                               
		return Redirect::action('FurnizorController@index')->with('flash_success', "Furnizorul a fost salvat cu success.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
		$input = Input::all();
		$asociatie_id = getInputOrSession('asociatie_id');
		$furnizor = Furnizori::find($id);
		$furnizor->fill($input);
                
        $furnizor->asociatie_id = $asociatie_id;
        $furnizor->save();
              
		return Redirect::action('FurnizorController@index')
			->with('flash_info', "Furnizorul a fost salvat.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Furnizori::find($id)->delete();
		return Redirect::action('FurnizorController@index')->with('flash_warning', "Furnizorul a fost sters.");
	}

}
