<?php
use Illuminate\Database\Eloquent\Model;

class FurnizoriController extends Model {

	protected $guarded = array();
    protected $table = 'furnizori';

	public static $rules = array();
        
    public function asociatie() {
        return $this->belongsTo('Asociatie', 'asociatie_id');
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
    
    public function scopeFromAsociatie($query, $asociatie_id) {
    	return $query->where('asociatie_id', '=', $asociatie_id);
    }

}
