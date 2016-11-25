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

		//
		
		Route::filter('nav', function() {
		        //var_dump(Auth::user());die();
			if(Auth::user()->type == 'super') { //type = 1 superadmin
				View::share('nav_left', array(
		            'Dashboard' => URL::action('DashboardController@index'),
					'Asociatii' => URL::Action('AsociatiesController@index'),
		            'Cheltuieli' => URL::Action('CheltuielisController@index'),
		            'Consum' => URL::Action('ConsumsController@index'),
		            'Calcule' => URL::Action('Cost_locatarisController@index'),
		            'Administratori' => URL::action('AdminsController@index'),
		            'Logout' => URL::action('AdminsController@logout')
				));
			} else if(Auth::user()->type == 'admin') { //type =2 administrator
				View::share('nav_left', array(
		            'Dashboard' => URL::action('DashboardController@index'),
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
