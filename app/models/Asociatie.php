<?php

class Asociatie extends Eloquent {
	protected $guarded = array();
        protected $table = 'asociatie';
        
	public static $rules = array();
        
        public function getSetari() {
		return $this->hasMany('Calcul_asociatie', 'asociatie_id');
	}
        
        public function getIncaperi() {
		return $this->hasMany('Asociatie_consum', 'asociatie_id');
	}
        
        public function asociatie_consum() {
		return $this->hasMany('Asociatie_consum', 'asociatie_id');
	}
}
