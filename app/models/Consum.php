<?php

class Consum extends Eloquent {
	protected $guarded = array();
    protected $table = 'consum';

	public static $rules = array();
        
    public function locatari() {
		return $this->belongsTo('locatari', 'locatar_id');
	}
        
    public function tipcontor() {
        return $this->belongsTo('Tipcontor', 'tipcontor_id');
    }

    public function scopeLocatarConsum($query, $locatar_id, $luna) {
		return $query->where('locatari_id', $locatar_id)
            ->where('luna', $luna);
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
