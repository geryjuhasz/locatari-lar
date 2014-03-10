<?php

class AdminsController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
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
        return View::make('admins.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		return View::make('login');
	}
	public function index() {
		$admins = Admin::all();
		$this->layout->content = View::make('admins.index')->with('admins', $admins);
	}
        
        public function login() {
		if(Auth::check()) return Redirect::to('/');
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
			$redir_url = Session::get('redir_url', '/');
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

}
