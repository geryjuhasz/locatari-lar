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
        
        public function getConsum($locatar_id, $tipconsum_id) {
		return $this->where('locatari_id', $locatar_id)
                        ->andwhere('tipconsum_id', $tipconsum_id);
	}
        
        public function scopeFromScara($query, $scara_id)
        {
            $locatari = Locatari::fromScara($scara_id)->get();
            foreach ($locatari as $locatar) {
                $ids[] = $locatar->id;
            }
            return $query->wherein('locatari_id', $ids);
        }
        
        public function scopeFromBloc($query, $bloc_id)
        {
            $locatari = Locatari::fromBloc($bloc_id)->get();
            foreach ($locatari as $locatar) {
                $ids[] = $locatar->id;
            }
            return $query->wherein('locatari_id', $ids);

        }
        
        public function scopeFromAsociatie($query, $asociatie_id)
        {
            $locatari = Locatari::fromAsociatie($asociatie_id)->get();
            foreach ($locatari as $locatar) {
                $ids[] = $locatar->id;
            }
            return $query->wherein('locatari_id', $ids);

        }
        
}
