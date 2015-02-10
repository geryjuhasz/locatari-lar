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
        
        public function scopeFromScara($query, $scara_id)
        {
            return $query->where('scara_id', '=', $scara_id);
        }
        
        public function scopeFromBloc($query, $bloc_id){
            $ids = array();
            $scaras = Scara::where('bloc_id', '=', $bloc_id)->get();
            foreach ($scaras as $scara) {
                $ids[] = $scara->id;
            }
            if($ids)
                return $query->wherein('scara_id', $ids);
            else return null;
        }
        
        public function scopeFromAsociatie($query, $asociatie_id){
            $ids = array();
            $scaras = Scara::fromAsociatie($asociatie_id)->get();
            foreach ($scaras as $scara) {
                $ids[] = $scara->id;
            }
            if($ids)
                return $query->wherein('scara_id', $ids);
            else return null;
        }
}
