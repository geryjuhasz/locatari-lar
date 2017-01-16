<?php

class Bloc extends Eloquent {
	protected $guarded = array();
    protected $table = 'bloc';

	public static $rules = array();
        
    public function asociatie() {
		return $this->belongsTo('Asociatie', 'asociatie_id');
	}

	public function scopeFromAsociatie($query, $asociatie_id) {
        return $query->where('asociatie_id', '=', $asociatie_id);
    }
}
