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
            $asociatie_id = getInputOrSession('asociatie_id');
            //$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
            $calcul = $asociatie_id!='0' ? Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)->get(): Calcul_asociatie::all();;
            $this->layout->content = View::make('calcul_asociaties.index')
			->with('calcul', $calcul)
			->with('asociatie_id', $asociatie_id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            
            $this->layout->content = View::make('calcul_asociaties.create')
                    ->with('asociatie_id', $asociatie_id);
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
		$calculasociatie = Calcul_asociatie::find($id);
		$calculasociatie->fill($input);
		$calculasociatie->save();
		
		return Redirect::action('Calcul_asociatiesController@index')->with('flash_success', "Calcul salvat.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Calcul_asociatie::find($id)->delete();
		return Redirect::action('Calcul_asociatiesController@index')->with('flash_warning', "Calcul sters.");
	}

}
