<?php

class Asociatie_consum extends Eloquent {
	protected $guarded = array();
        protected $table = 'asociatie_consum';

	public static $rules = array();
        
    public function asociatie() {
		return $this->belongsTo('Asociatie', 'asociatie_id');
	}
        
    public function tipconsum() {
		return $this->belongsTo('Tipconsum', 'tipconsum_id');
	}
    
    public function tipincapere() {
		return $this->belongsTo('Tipincapere', 'tipincapere_id');
        }
}
