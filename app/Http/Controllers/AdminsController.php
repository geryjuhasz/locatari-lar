<?php

class AdminsController extends Controller {
        protected $layout = 'layout';
        
        public function __construct() {
            View::share('active_link', 'Administratori');
            $admin = Auth::user();
            if(!$admin) return; //Login or logout actions are permitted
            //var_dump($route);die();
            //if($route) list($controller, $action) = explode('@', $route->getAction());
      
//            if($admin->type === 'editor' && !in_array($action, array('login', 'loginForm', 'logout'))) {
//                return Redirect::action('AdsController@index')->with('flash_warning', 'Permission denied.');
//            }
//            $this->beforeFilter(function() use($admin) {
//                if($admin->type !== 'super') {
//                    return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
//                }
//            });
	}
        
        public function index() {
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            $admins = Admin::all();
            return View::make('admins.index')->with('admins', $admins);
	}
        
        /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            return View::make('admins.form');

            //return View::make('admins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            $input = Input::except('_method', '_token');
            $result = $this->createOrUpdate($input);
            if(!$result['success']) {
                    Input::flash();
                    return Redirect::action('AdminsController@create')->with('flash_error', $result['validator']->messages());
            }
            return Redirect::action('AdminsController@index')->with('flash_success', 'Admin created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            return View::make('admins.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            $admin = Admin::find($id);
            return View::make('admins.form')
			->with('admin', $admin);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
        
	public function update($id)
	{
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            $input = Input::except('_method', '_token');
            $result = $this->createOrUpdate($input, $id);
            if(!$result['success']) {
                    Input::flash();
                    return Redirect::action('AdminsController@edit', $id)->with('flash_error', $result['validator']->messages());
            }
            return Redirect::action('AdminsController@index')->with('flash_info', 'Admin updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
        
    public function loginForm() {
        	
		if(Auth::check()) return Redirect::to('/');
		return View('login');
	}
	
        
    public function login() {
		if(Auth::check()) return Redirect::to('dashboard');
		$input = Input::all();
		$remember = Input::get('remember') ? true : false;
		$validator = Validator::make($input, array(
			'name' => 'required',
			'password' => 'required|min:4'
		));
		
		if($validator->fails()) {
			return Redirect::action('AdminsController@login')->with('flash_error', $validator->messages());
		}
		if(Auth::attempt(array('username' => Input::get('name'), 'password' => Input::get('password')), $remember)) {
			$redir_url = Session::get('redir_url', 'dashboard');
                        Session::forget('redir_url');
                        return Redirect::to($redir_url);
		} else {
			return Redirect::action('AdminsController@login')->with('flash_error', 'Invalid username or password.');
		}
	}
	public function logout() {
		Auth::logout();
		return Redirect::action('AdminsController@loginForm')->with('flash_info', 'Logged out.');
	}

        private function createOrUpdate($input, $id = null) {
            if(Auth::user()->type !== 'super') {
                return Redirect::action('DashboardController@index')->with('flash_warning', 'Permission denied.');
            }
            $admin = $id? Admin::find($id) : new Admin();
            $rules = array(
                'name' => 'required|unique:users,name,'.$admin->id,
		'email' => 'required|email|unique:users,email,'.$admin->id
            );
		
            if(Auth::user()->isAdmin()) {
		$rules['type'] = 'in:editor,admin';
            }
            
            if($id) $rules['password'] = 'min:4|confirmed';
            else $rules['password'] = 'required|min:4|confirmed';
            $validator = Validator::make($input, $rules);
            if($validator->fails()) return array('success' => false, 'validator' => $validator);
            
		$data = $input;
		unset($data['password_confirmation']);
		if($data['password'])
			$data['password'] = Hash::make($data['password']);
		else
			unset($data['password']);
		Admin::unguard();
		$admin->fill($data);
		$admin->save();
		Admin::reguard();
		
		return array('success' => true, 'admin' => $admin);
	}
}
