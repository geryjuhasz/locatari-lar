<?php

class Calcul_asociatie extends Eloquent {
	protected $guarded = array();
    protected $table = 'calcul_asociatie';
	public static $rules = array();
        
    public function Tipcheltuieli() {
		return $this->belongsTo('Tipcheltuieli', 'tipcheltuieli_id');
	}
    public function Tipcalculrepartitie() {
		return $this->belongsTo('Tipcalculrepartitie', 'tipcalculrepartitie_id');
    }
    public function Tiprepartitie() {
		return $this->belongsTo('Tiprepartitie', 'tiprepartitie_id');
    }
        
        //$object_id can be type Asociatie, Bloc, Scara, Apartament
        //$tiprepartitie - will be: 1 - Asociatie, 2 - Bloc, 3 - Scara, 4 - Apartament
    public function getNoPersons($objectid){
        if($this->tiprepartitie_id == 1){
            $locatari = Locatari::where('asociatie_id', '=', $object_id)->get();
            return count($locatari);
        }
        if($this->tiprepartitie_id == 2){
            
            $locatari = Locatari::where('scara_id', '=', $scara_id)->get();
            return count($locatari);
        }
    }
}
