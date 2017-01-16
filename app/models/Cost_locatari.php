<?php

class Cost_locatari extends Eloquent {
	protected $guarded = array();
    protected $table = 'cost_locatari';

	public static $rules = array();
        
    public function locatari() {
        return $this->belongsTo('locatari', 'locatari_id');
	}
        
        public function scopeFromScara($query, $scara_id)
        {
            $ids = array();
            $locatari = array();
            $locatari = Locatari::fromScara($scara_id)->get();
            
            foreach ($locatari as $locatar) {
                $ids[] = $locatar->id;
            }
            
            if(!empty($ids)){
                return $query->wherein('locatari_id', $ids);
            }
            else return null;
        }
        
        public function scopeFromAsociatie($query, $asociatie_id)
        {
            $ids = array();
            $locatari = Locatari::fromAsociatie($asociatie_id)->get();
            foreach ($locatari as $locatar) {
                $ids[] = $locatar->id;
            }
            if($ids)
                return $query->wherein('locatari_id', $ids);
            else return null;
        }
}
