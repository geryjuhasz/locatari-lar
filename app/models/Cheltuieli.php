<?php

use Illuminate\Database\Eloquent\Model;

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
		public function furnizori() {
			return $this->belongsTo('Furnizori', 'furnizor_id');
		}
		public function scopeFromAsociatie($query, $asociatie_id){
        	return $query->where('asociatie_id', '=', $asociatie_id);
    	}

	}
