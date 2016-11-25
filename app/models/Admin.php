<?php

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

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