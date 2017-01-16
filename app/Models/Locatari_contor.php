<?php 

use Illuminate\Database\Eloquent\Model;

class Locatari_contor extends Model {
	protected $guarded = array();
    protected $table = 'locatari_contor';

    public static $rules = array();
    
    public function locatar() {
		return $this->belongsTo('Locatar', 'locatar_id');
	}
	public function tipcontor() {
		return $this->belongsTo('Tipcontor', 'tipcontor_id');
    }
	public function scopeFromLocatar($query, $locatari_id) {
        return $query->where('locatari_id', '=', $locatari_id);
    }
}
