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
        
    public function scopeFromBloc($query, $bloc_id) {
        return $query->where('bloc_id', '=', $bloc_id);
    }
        
    public function scopeFromAsociatie($query, $asociatie_id){
            $blocs = Bloc::where('asociatie_id', '=', $asociatie_id)->get();
            foreach ($blocs as $bloc) {
                $ids[] = $bloc->id;
            }
            if($ids)
                return $query->wherein('bloc_id', $ids);
            else return null;
        }
               
}
