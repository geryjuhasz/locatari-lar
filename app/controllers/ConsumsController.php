<?php

class ConsumsController extends BaseController {
        protected $layout = 'layout';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            $asociatie = Asociatie::Find($asociatie_id); 
            $scara_id = getInputOrSession('scara_id');
            $luna = getDateInputOrSession('luna');
            
            $tipconsum_id = getInputOrSession('tipconsum_id');
            
            if ($scara_id != 0) $locatari = Scara::find($scara_id)->locatari;
            else $locatari = array();
            //$consum['Locatari'] = $locatari;
            
            //get locatari data without consum
//            $query = Locatari::query()->leftjoin('scara', 'scara.id', '=', 'locatari.scara_id');
//            $query = $query->where('scara.id', '=', $scara_id);
//            $query = $query->select('locatari.nume', 'locatari.nr_apartament');
//            $consum['Locatari'] = $locatari;

            //die();
            //$a = Asociatie_consum::find($asociatie_id);

            $asociatie_consum = Asociatie_consum::where('asociatie_id', '=', $asociatie_id)
                ->where('tipconsum_id', '=',$tipconsum_id )
            ->get();
            
            $consum = array();
            foreach ($asociatie_consum as $aconsum) {
                $query = Locatari::query()->leftjoin('scara', 'scara.id', '=', 'locatari.scara_id');
                $query = $query->where('scara.id', '=', $scara_id);

                $query = $query->leftjoin('consum', 'consum.locatari_id', '=', 'locatari.id');
                $query = $query->where('consum.luna', '=', '2014-01-01');
                $query = $query->where('consum.tipconsum_id', '=', $tipconsum_id);
                $query = $query->where('consum.tipincapere_id', '=', $aconsum->tipincapere->id);
                $query = $query->select('locatari.id', 'locatari.nume', 'locatari.nr_apartament', 'consum.index_vechi_rece', 'consum.index_nou_rece', 'consum.index_vechi_calda', 'consum.index_nou_calda');
                $cons['Name']=$aconsum->tipincapere->denumire;
                $cons['Consum'] = $query->get();
                $consum[] = $cons;
            }

            $consums = array();
            $tabel = array() ;

            foreach ($locatari as $locatar) {
                $consum_locatar = array();
                $consum_locatar['nr_apartament'] = $locatar->nr_apartament;
                $tabel['nr_apartament'] = 'Nr. apartament';
                $consum_locatar['nume'] = $locatar->nume;
                $tabel['locatar'] = 'Nume locatar';
                foreach ($asociatie_consum as $aconsum) {
                    $incapere = $aconsum->tipincapere->denumire;
                    $tabel[$incapere.'_rece'] = $incapere.' Rece';
                    $tabel[$incapere.'recev'] = '';
                    $consum_locatar['index_vechi_rece_'.$incapere] = 0;
                    $consum_locatar['index_nou_rece_'.$incapere] = 0;
                    $tabel[$incapere.'_calda'] = ' Calda';
                    $tabel[$incapere.'caldav'] = '';
                    $consum_locatar['index_vechi_calda_'.$incapere] = 0;
                    $consum_locatar['index_nou_calda_'.$incapere] = 0;
                    $consum_locatar['consum_rece_'.$incapere] = 0;
                    $tabel[$incapere.'_consum_rece'] = 'Consum Rece';
                    $consum_locatar['consum_calda_'.$incapere] = 0;
                    $tabel[$incapere.'_consum_calda'] = 'Calda';

                }
                $consum_locatar['locatar_id'] = $locatar->id;
                $consums[$locatar->id] = $consum_locatar;
            }
            
            foreach ($consum as $c) {
                $c1 = $c['Consum']; 
                $incapere = $c['Name'];
                if (count($c1) > 0) {
                    foreach($c1 as $cons){
                        $consums[$cons->id]['index_vechi_rece_'.$incapere] = $cons->index_vechi_rece;
                        $consums[$cons->id]['index_nou_rece_'.$incapere] = $cons->index_nou_rece;
                        $consums[$cons->id]['index_vechi_calda_'.$incapere] = $cons->index_vechi_calda;
                        $consums[$cons->id]['index_nou_calda_'.$incapere] = $cons->index_nou_calda;
                        $consums[$cons->id]['consum_rece_'.$incapere] = round($cons->index_nou_rece - $cons->index_vechi_rece, 2);
                        $consums[$cons->id]['consum_calda_'.$incapere] = round($cons->index_nou_calda - $cons->index_vechi_calda, 2);
                    }
                }
            }
            
            $this->layout->content = View::make('consums.index')
			->with('consum', $consums)
                        ->with('tabel', $tabel)
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
            $asociatie_id = getInputOrSession('asociatie_id');
            $asociatie = Asociatie::Find($asociatie_id); 
            $scara_id = getInputOrSession('scara_id');
            $luna = getDateInputOrSession('luna');
            $tipconsum_id = getInputOrSession('tipconsum_id');
            $locatar_id = getInputOrSession('locatar_id');
            
            $asociatie_consum = array();
            if( $tipconsum_id<>0 ) {
                $asociatie_consum = Asociatie_consum::where('asociatie_id', '=', $asociatie_id)
                    ->where('tipconsum_id', '=',$tipconsum_id )
                ->get();
            }
            
            $this->layout->content = View::make('consums.create')
		->with('asociatie_consum', $asociatie_consum)
                ->with('locatar_id', $locatar_id);	
                    //->with('consum', $asociatie_consum);
                       
            //return View::make('consums.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $asociatie_id = getInputOrSession('asociatie_id');
            $asociatie = Asociatie::Find($asociatie_id); 
            $scara_id = getInputOrSession('scara_id');
            $luna = getDateInputOrSession('luna');
            $tipconsum_id = getInputOrSession('tipconsum_id');
            $locatar_id = getInputOrSession('locatar_id');
            
            $asociatie_consum = Asociatie_consum::where('asociatie_id', '=', $asociatie_id)
                    ->where('tipconsum_id', '=',$tipconsum_id )
                ->get();
            
            $input = Input::all();
            
            foreach($asociatie_consum as $ac) {
                $consum = new Consum();
                $consum->locatari_id = $locatar_id;
                $consum->luna = $luna;
                $consum->tipconsum_id = $input['tipconsum_id'];
                $consum->tipincapere_id = $ac->tipincapere->id;
                $consum->index_vechi_rece = $input[$ac->tipincapere->denumire.'_index_vechi_rece'];
                $consum->index_nou_rece = $input[$ac->tipincapere->denumire.'_index_nou_rece'];
                $consum->index_vechi_calda = $input[$ac->tipincapere->denumire.'_index_vechi_calda'];
                $consum->index_nou_calda = $input[$ac->tipincapere->denumire.'_index_nou_calda'];
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
        return View::make('consums.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('consums.edit');
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
		//
	}

}

class ConsumLocatar {
    protected $locatar_id = 0;
    public $index_vechi_rece = 0;
    public $index_nou_rece = 0;
    public $index_vechi_calda = 0;
    public $index_nou_calda = 0;
   
    
}