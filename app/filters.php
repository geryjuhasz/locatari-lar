<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});



Route::filter('nav', function() {
	//if(Auth::user()->type == 'super') {
		View::share('nav_left', array(
			'Asociatie' => URL::Action('AsociatiesController@index'),
			'Bloc' => URL::action('BlocsController@index'),
                        'Scara' => URL::action('ScarasController@index'),
                        'Locatari' => URL::action('LocatarisController@index')
		));
//	} else if(Auth::user()->type == 'admin') {
//		View::share('nav_left', array(
//			'Content' => URL::Action('ArticlesController@index'),
//			'Categories' => URL::action('CategoriesController@index'),
//			'Ads' => URL::action('AdsController@index'),
//			'Users' => URL::action('UsersController@index'),
//			'Admins' => URL::action('AdminsController@index'),
//			'Logout' => URL::action('AdminsController@logout')
//		));
//	} else {
//		View::share('nav_left', array(
//			'Categories' => URL::action('CategoriesController@index'),
//			'Ads' => URL::action('AdsController@index'),
//			'Users' => URL::action('UsersController@index'),
//			'Logout' => URL::action('AdminsController@logout')
//		));
//	}
	View::share('nav_left_active', '');
	View::share('nav_top_active', '');
});