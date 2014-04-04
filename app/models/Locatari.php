<?php

class Locatari extends Eloquent {
	protected $guarded = array();
        protected $table = 'locatari';

	public static $rules = array();
        
        public function scara() {
		return $this->belongsTo('Scara', 'scara_id');
	}
        
        public function asociatie() {
		return $this->belongsTo('Asociatie', 'asociatie_id');
	}
        
        public function consum() {
            return $this->hasMany('Consum');
        }
        
}
