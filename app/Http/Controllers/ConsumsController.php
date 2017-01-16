<?php

class ConsumsController extends Controller {
    //protected $layout = 'layout';
        
    public function __construct() {
        View::share('active_link', 'Consum');
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
        $asociatie = Asociatie::Find($asociatie_id); 
        $bloc = Bloc::FromAsociatie($asociatie_id)->get();
        View::share('bloc', $bloc);
        $bloc_id = getInputOrSession('bloc_id');
        View::share('bloc_id', $bloc_id);
        $scara = Scara::FromBloc($bloc_id)->get();
        View::share('scara', $scara);
        $scara_id = getInputOrSession('scara_id');
        View::share('scara_id', $scara_id);
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
            
        if ($scara_id != 0) $locatari = Locatari::FromScara($scara_id)->get();
        else $locatari = array();

        $details = array();
        $consum_locatar = array();
        $tabel = array() ;
        $tabelfooter = array();
        
        if(!empty($locatari)) {
            foreach($locatari as $locatar) {
                $details_locatar = array();
                $details_locatar['locatar_id'] = $locatar->id;
                $details_locatar['nr_apartament'] = $locatar->nr_apartament;
                $details_locatar['nume'] = $locatar->nume;
                $details[$locatar->id] = $details_locatar;

                $consum = array();
                $locatar_contoare = array();
                $locatar_contoare = Locatari_contor::FromLocatar($locatar->id)->get();
                //$locatar_contor = LocatarContor::
                foreach ($locatar_contoare as $contor) {
                    $query = Consum::LocatarConsum($locatar->id, $luna);
                    //$query = $query->where('consum.luna', '=',$luna);
                    $query = $query->where('consum.tipcontor_id', '=', $contor->tipcontor->id);
                    $cons = $query->get();
                    
                    if(!$cons->isEmpty()){
                        foreach($cons as $c){
                            $consum[] = $c;
                        }
                    }
                    else {
                        $consuml = new Consum();
                        $consuml->locatari_id = $locatar->id;
                        $consuml->luna = $luna;
                        $consuml->tipcontor_id = $contor->tipcontor->id;
                        $consuml->index_vechi = 0;
                        $consuml->index_nou = 0;
                        $consuml->consum = 0;
                        $consum[] = $consuml;
                    }
                    
                }

                $consum_locatar[$locatar->id] = $consum;
                //$consums[$locatar->id] = $consum_locatar;
            }
            
       }  

    return View::make('consums.index')
            ->with('locatari', $locatari)
            ->with('consum', $consum_locatar)
            ->with('tabel', $tabel)
            ->with('tabelfooter', $tabelfooter)
            ->with('luna', $luna)
            ->with('asociatie', $asociatie);  
	}

    public function select()
    {
        $asociatie_id = getInputOrSession('asociatie_id');
        $asociatie = Asociatie::Find($asociatie_id); 
        $bloc = Bloc::FromAsociatie($asociatie_id)->get();
        View::share('bloc', $bloc);
        $bloc_id = getInputOrSession('bloc_id');
        View::share('bloc_id', $bloc_id);
        $scara = Scara::FromBloc($bloc_id)->get();
        View::share('scara', $scara);
        $scara_id = getInputOrSession('scara_id');
        View::share('scara_id', $scara_id);
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
        return Redirect::action('ConsumsController@index');
    }

    public function generate()
    {
        return View::make('consums.index')
            ->with('locatari', $locatari)
            ->with('consum', $consum_locatar)
            ->with('tabel', $tabel)
            ->with('tabelfooter', $tabelfooter)
            ->with('luna', $luna)
            ->with('asociatie', $asociatie);  
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
        $locatar_id = getInputOrSession('locatar_id');
            
        $locatar_contoare = array();
        $locatar_contoare = Locatari_contor::FromLocatar($locatar_id)->get();
        $consum = array();
        $ids = '';
        foreach ($locatar_contoare as $contor) {
            $query = Consum::LocatarConsum($locatar_id, $luna);
            $query = $query->where('consum.tipcontor_id', '=', $contor->tipcontor->id);
            $cons = $query->get();
            if(!$cons->isEmpty()){
                foreach($cons as $c){
                    $consum[] = $c;
                    $ids .= $c->id.',';
                }
                $action = array('ConsumsController@update', $ids);
                $method = 'PUT';
            }
            else {
                $action = 'ConsumsController@store';
                $method = 'POST';  
                $consum1 = new Consum();
                $consum1->locatar_id = $locatar_id;
                $consum1->tipcontor_id = $contor->tipcontor->id;
                $consum1->index_vechi = 0;
                $consum1->index_nou = 0;
                $consum1->consum = 0;
                //$consum1.save();
                $consum[] = $consum1;  
            }
        }
    View::share('action', $action);     
    View::share('method', $method);     
    View::share('contoare', $locatar_contoare);     
    View::share('consum', $consum);     

    return View::make('consums.create')
		  ->with('locatar_id', $locatar_id);	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
        $locatar_id = getInputOrSession('locatar_id');
        
        $locatar_contoare = array();
        $locatar_contoare = Locatari_contor::FromLocatar($locatar_id)->get();
        
        $input = Input::all();
        foreach($locatar_contoare as $ac) {
            $consum = new Consum();
            $consum->locatari_id = $locatar_id;
            $consum->luna = $luna;
            $consum->tipcontor_id = $ac->tipcontor->id;
            $consum->index_vechi = $input[str_replace(" ", "_", $ac->tipcontor->denumire).'_index_vechi'];
            $consum->index_nou = $input[str_replace(" ", "_", $ac->tipcontor->denumire).'_index_nou'];
            $consum->consum = $input[str_replace(" ", "_", $ac->tipcontor->denumire).'_consum'];
            $consum->save();
        }
        
        return Redirect::action('ConsumsController@index')->with('flash_success', "Consumul a fost salvat.");
        
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $asociatie_id = getInputOrSession('asociatie_id');
        $asociatie = Asociatie::Find($asociatie_id); 
        $bloc = Bloc::FromAsociatie($asociatie_id)->get();
        View::share('bloc', $bloc);
        $bloc_id = getInputOrSession('bloc_id');
        View::share('bloc_id', $bloc_id);
        $scara = Scara::FromBloc($bloc_id)->get();
        View::share('scara', $scara);
        $scara_id = getInputOrSession('scara_id');
        View::share('scara_id', $scara_id);
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
            
        if ($scara_id != 0) $locatari = Locatari::FromScara($scara_id)->get();
        else $locatari = array();

        $consum = Asociatie_consum::where('asociatie_id', '=', $asociatie_id)->get();
        //var_dump($consum);
        foreach ($locatari as $locatar) {
            $locatar_consum = Locatari_contor::FromLocatar($locatar->id)->get();
            if($locatar_consum->isEmpty()){
                foreach ($consum as $asociatie_consum){
                    $consuml = new Locatari_contor();
                    $consuml->locatari_id = $locatar->id;
                    $consuml->tipcontor_id = $asociatie_consum->tipcontor_id;
                    $consuml->save();
                }
                
            }
            //else var_dump($locatar_consum);

        }
        Redirect::action('ConsumsController@index')->with('flash_success', 'Generat.');
        //return View::make('consums.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!Consum::find($id)) {
		  return Redirect::action('ConsumsController@index');
        }
        return View::make('consums.create')
		  ->with('$consumlocatar', Consum::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($ids)
	{
        $luna = date_format(new Datetime(getDateInputOrSession('luna')), 'Y-m-d');
        $locatar_id = getInputOrSession('locatar_id');
        
        $input = Input::all();
        $ids_array = explode(',', $ids);
        foreach($ids_array as $id){
            if(!empty($id)){
                $consum = Consum::find($id);
                //$consum->locatari_id = $locatar_id;
                //$consum->luna = $luna;
                //$consum->tipcontor_id = $ac->tipcontor->id;
                $consum->index_vechi = $input[str_replace(" ", "_", $consum->tipcontor->denumire).'_index_vechi'];
                $consum->index_nou = $input[str_replace(" ", "_", $consum->tipcontor->denumire).'_index_nou'];
                $consum->consum = $input[str_replace(" ", "_", $consum->tipcontor->denumire).'_consum'];
                $consum->save();
            }
            
        }
        return Redirect::action('ConsumsController@index')->with('flash_success', "Consumul a fost salvat.");  
                
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

class ConsumLocatar {
    protected $locatar_id = 0;
    public $tipcontor_id = 0;
    public $index_vechi = 0;
    public $index_nou = 0;
}