<?php

class Asociatie extends Eloquent {
	protected $guarded = array();
        protected $table = 'asociatie';
        
	public static $rules = array();
        
        public function getSetari($id) {
		return $this->belongsTo('Calcul_asociatie', 'asociatie_id');
	}
}
