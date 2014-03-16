<?php

class Calcul_asociatie extends Eloquent {
	protected $guarded = array();
        protected $table = 'calcul_asociatie';

	public static $rules = array();
        
        public function Tipcheltuieli() {
		return $this->belongsTo('Tipcheltuieli', 'tipcheltuieli_id');
	}
}
