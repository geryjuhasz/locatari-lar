<?php
use Illuminate\Auth\UserInterface;

class Admin extends Eloquent implements UserInterface {
    protected $table = 'users';
    protected $guarded = array('password');
    protected $hidden = array('password');
    public static $rules = array();

    public static $types = array('super' => 'Super', 'admin' => 'Admin', 'editor' => 'Editor');
    public static $types_restricted = array('admin' => 'Admin', 'editor' => 'Editor');
	
    public function getAuthIdentifier() {
        return $this->getKey();
    }
    public function getAuthPassword() {
        return $this->password;
    }
    
    public function isSuper() {
        return $this->type === 'super';
    }
    public function isAdmin() {
        return $this->type === 'admin';
    }
    public function isEditor() {
        return $this->type === 'editor';
    }
	
        
}