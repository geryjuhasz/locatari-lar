<?php

class Consum extends Eloquent {
	protected $guarded = array();
        protected $table = 'consum';

	public static $rules = array();
        
        public function locatari() {
		return $this->belongsTo('locatari', 'locatar_id');
	}
        
        public function tipincapere() {
		return $this->belongsTo('tipincapere', 'tipincapere_id');
	}
        
}
