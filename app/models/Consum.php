<?php

class Consum extends Eloquent {
	protected $guarded = array();
        protected $table = 'consum';

	public static $rules = array();
        
        public function locatari() {
		return $this->belongsTo('Locatari', 'locatar_id');
	}
        
        
}
