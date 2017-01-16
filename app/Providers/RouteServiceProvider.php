<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Session;
use Redirect;
use Auth;
use View;
use URL;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = null;

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		Route::filter('nav', function() {
			if(Auth::user()->type == 'super') { //type = 1 superadmin
				View::share('nav_left', array(
		            'Pagina de start' => URL('admin'),
		            'Avizier' => URL(''),
					'Cheltuieli' => URL::Action('CheltuielisController@index'),
		            'Consum' => URL::Action('ConsumsController@index'),
		            'Incasari' => URL(''),
		            'Calcule' => URL::Action('Cost_locatarisController@index'),
		            'Asociatii' => URL::Action('AsociatiesController@index'),
		            'Administratori' => URL::action('AdminsController@index'),
		            'Logout' => URL::action('AdminsController@logout')
				));
			} else if(Auth::user()->type == 'admin') { //type =2 administrator
				View::share('nav_left', array(
		            'Pagina de start' => URL('admin'),
		            'Cheltuieli' => URL::Action('CheltuielisController@index'),
		            'Consum' => URL::Action('ConsumsController@index'),
		            'Calcule' => URL::Action('Cost_locatarisController@index'),
					'Logout' => URL::action('AdminsController@logout')
				));
			} else {
		        	View::share('nav_left', array( 
		                'Dashboard' => URL::action('DashboardController@index'),
		                //'Asociatii' => URL::Action('AsociatiesController@index'),
		                //'Cheltuieli' => URL::Action('CheltuielisController@index'),
		                //'Consum' => URL::Action('ConsumsController@index'),
		                //'Calcule' => URL::Action('Cost_locatarisController@index'),
						'Logout' => URL::action('AdminsController@logout')
				));
			}
			View::share('nav_left_active', '');
			View::share('nav_top_active', '');
		});

		Route::filter('backend_auth', function() {
		    if (Auth::guest()) {
		        //Save requested URL in order to redirect afterwards
		        Session::put('redir_url', URL::current());
		        return Redirect::action('AdminsController@login');
		    }
			if(!Auth::check()) {
				return Redirect::action('AdminsController@login');
			}
		});


	Route::resource('/', 'Frontend@index');

	Route::group(array('before' => 'backend_auth|nav'), function() {
		Route::resource('blocs', 'BlocsController');
    	Route::resource('asociaties', 'AsociatiesController');
    	Route::post('asociaties', 'AsociatiesController@select');
		Route::resource('scaras', 'ScarasController');
    	Route::resource('locataris', 'LocatarisController');
    	Route::resource('furnizors', 'FurnizorController');
    	Route::resource('calcul_asociaties', 'Calcul_asociatiesController');
    	//Route::post('consums/store', ['as' => 'consums.store', 'uses' => 'ConsumsController@store']);
    	
    	Route::resource('consums', 'ConsumsController');
    	//Route::post('consums', 'ConsumsController@index');
    	Route::post('consums/select', ['as' => 'consums.select', 'uses' => 'ConsumsController@select']);
    	Route::post('consums', ['as' => 'consums.store', 'uses' => 'ConsumsController@store']);
    	Route::post('consums/generate', ['as' => 'consums.generate', 'uses' => 'ConsumsController@generate']);
    	
    	Route::resource('locatarcontor', 'LocatarContor');
    	Route::resource('cheltuielis', 'CheltuielisController');
    	Route::resource('cost_locataris', 'Cost_locatarisController');
    	Route::resource('asociatie_consums', 'Asociatie_consumsController');
    	Route::resource('admins', 'AdminsController');
    	Route::resource('dashboard', 'DashboardController');
    	Route::get('logout_admin', 'AdminsController@logout');
    	Route::get('admin', function () {
   	 		return view('blank');
		});


		// Sentinel Users
    Route::get('users', ['as' => 'sentinel.users.index', 'uses' => 'UserController@index']);
    Route::get('users/create', ['as' => 'sentinel.users.create', 'uses' => 'UserController@create']);
    Route::post('users', ['as' => 'sentinel.users.store', 'uses' => 'UserController@store']);
    Route::get('users/{hash}', ['as' => 'sentinel.users.show', 'uses' => 'UserController@show']);
    Route::get('users/{hash}/edit', ['as' => 'sentinel.users.edit', 'uses' => 'UserController@edit']);
    Route::post('users/{hash}/password', ['as' => 'sentinel.password.change', 'uses' => 'UserController@changePassword']);
    Route::post('users/{hash}/memberships', ['as' => 'sentinel.users.memberships', 'uses' => 'UserController@updateGroupMemberships']);
    Route::put('users/{hash}', ['as' => 'sentinel.users.update', 'uses' => 'UserController@update']);
    Route::delete('users/{hash}', ['as' => 'sentinel.users.destroy', 'uses' => 'UserController@destroy']);
    Route::get('users/{hash}/suspend', ['as' => 'sentinel.users.suspend', 'uses' => 'UserController@suspend']);
    Route::get('users/{hash}/unsuspend', ['as' => 'sentinel.users.unsuspend', 'uses' => 'UserController@unsuspend']);
    Route::get('users/{hash}/ban', ['as' => 'sentinel.users.ban', 'uses' => 'UserController@ban']);
    Route::get('users/{hash}/unban', ['as' => 'sentinel.users.unban', 'uses' => 'UserController@unban']);

});



Route::get('login_admin', array('as' => 'login', 'uses' => 'AdminsController@loginForm'));
Route::post('login_admin', array('as' => 'login', 'uses' => 'AdminsController@login'));


//Route::group(['namespace' => 'Sentinel\Controllers'], function () {

    // Sentinel Session Routes
//    Route::get('login', ['as' => 'sentinel.login', 'uses' => 'SessionController@create']);
  //  Route::get('logout', ['as' => 'sentinel.logout', 'uses' => 'SessionController@destroy']);
  //  Route::get('sessions/create', ['as' => 'sentinel.session.create', 'uses' => 'SessionController@create']);
  //  Route::post('sessions/store', ['as' => 'sentinel.session.store', 'uses' => 'SessionController@store']);
  //  Route::delete('sessions/destroy', ['as' => 'sentinel.session.destroy', 'uses' => 'SessionController@destroy']);

    // Sentinel Registration
    //Route::get('register', ['as' => 'sentinel.register.form', 'uses' => 'RegistrationController@registration']);
//    Route::post('register', ['as' => 'sentinel.register.user', 'uses' => 'RegistrationController@register']);
//    Route::get('users/activate/{hash}/{code}', ['as' => 'sentinel.activate', 'uses' => 'RegistrationController@activate']);
  //  Route::get('reactivate', ['as' => 'sentinel.reactivate.form', 'uses' => 'RegistrationController@resendActivationForm']);
 //   Route::post('reactivate', ['as' => 'sentinel.reactivate.send', 'uses' => 'RegistrationController@resendActivation']);
 //   Route::get('forgot', ['as' => 'sentinel.forgot.form', 'uses' => 'RegistrationController@forgotPasswordForm']);
 //   Route::post('forgot', ['as' => 'sentinel.reset.request', 'uses' => 'RegistrationController@sendResetPasswordEmail']);
 //   Route::get('reset/{hash}/{code}', ['as' => 'sentinel.reset.form', 'uses' => 'RegistrationController@passwordResetForm']);
 //   Route::post('reset/{hash}/{code}', ['as' => 'sentinel.reset.password', 'uses' => 'RegistrationController@resetPassword']);

    // Sentinel Profile
 //   Route::get('profile', ['as' => 'sentinel.profile.show', 'uses' => 'ProfileController@show']);
 //   Route::get('profile/edit', ['as' => 'sentinel.profile.edit', 'uses' => 'ProfileController@edit']);
 //   Route::put('profile', ['as' => 'sentinel.profile.update', 'uses' => 'ProfileController@update']);
  //  Route::post('profile/password', ['as' => 'sentinel.profile.password', 'uses' => 'ProfileController@changePassword']);

    
    // Sentinel Groups
 //   Route::get('groups', ['as' => 'sentinel.groups.index', 'uses' => 'GroupController@index']);
 //   Route::get('groups/create', ['as' => 'sentinel.groups.create', 'uses' => 'GroupController@create']);
//    Route::post('groups', ['as' => 'sentinel.groups.store', 'uses' => 'GroupController@store']);
 //   Route::get('groups/{hash}', ['as' => 'sentinel.groups.show', 'uses' => 'GroupController@show']);
 //   Route::get('groups/{hash}/edit', ['as' => 'sentinel.groups.edit', 'uses' => 'GroupController@edit']);
 //   Route::put('groups/{hash}', ['as' => 'sentinel.groups.update', 'uses' => 'GroupController@update']);
 //   Route::delete('groups/{hash}', ['as' => 'sentinel.groups.destroy', 'uses' => 'GroupController@destroy']);
//});






	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
