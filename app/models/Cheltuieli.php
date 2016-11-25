<?php

    class Cheltuieli extends Eloquent {
		protected $guarded = array();
       	protected $table = 'cheltuieli';
        
		public static $rules = array();
        
        public function tipcheltuieli() {
			return $this->belongsTo('Tipcheltuieli', 'tipcheltuieli_id');
        }
        public function asociatie() {
			return $this->belongsTo('Asociatie', 'asociatie_id');
		}
	}
