<?php
use Illuminate\Auth\UserInterface;

class Admin extends Eloquent implements UserInterface {
    
public function isSuper() {
    return $this->type === 'super';
  }
  public function isAdmin() {
    return $this->type === 'admin';
  }
  public function isEditor() {
    return $this->type === 'editor';
  }
	public function moduleRights() {
		$modules = array();
		if(!$this->rights) return array();
		foreach($this->rights as $right) {
			$module = $right->fk_module;
			if(empty($modules[$module])) $modules[$module] = array();
			array_push($modules[$module], $right->name);
		}
		return $modules;
	}
	public function moduleRightsFor($module) {
		if(!$this->rights) return array();
		$rights = array();
		foreach($this->rights as $right) {
			if($right->module->name == $module) {
				$rights[] = $right->name;
			}
		}
		return $rights;
	}
	public function actionAllowed($module, $action, $allowedActions = array()) {
		$allowedActions = $allowedActions?: array('index');
		if(!in_array('index', $allowedActions)) array_push($allowedActions, 'index');
		$rights = $this->rights()->get();
		if($this->type == 'super') {
			return true;
		} else if($this->type == 'admin') {
			return true;
		} else if($this->type == 'editor') {
			if(in_array($action, $allowedActions)) {
				return true;
			}
			
			foreach($rights as $right) {
				if($right->module->name == $module) {
					switch($right->name) {
						case 'create':
							if(in_array($action, array('create', 'store'))) return true;
						break;
						case 'edit':
							if(in_array($action, array('edit', 'update'))) return true;
						break;
						case 'delete':
							if(in_array($action, array('delete'))) return true;
						break;
					}
				}
			}
		}
		return false;
	}

}