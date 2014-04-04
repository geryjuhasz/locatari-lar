<?php

class Scara extends Eloquent {
	protected $guarded = array();
        protected $table = 'scara';

	public static $rules = array();
        
        public function bloc() {
		return $this->belongsTo('Bloc', 'bloc_id');
	}
        
        public function locatari() {
            return $this->hasMany('Locatari');
        }
               
}
