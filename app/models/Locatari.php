<?php

class Locatari extends Eloquent {
	protected $guarded = array();
        protected $table = 'locatari';

	public static $rules = array();
        
        public function scara() {
		return $this->belongsTo('Scara', 'scara_id');
	}
}
