<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class HelperServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
			//	var_dump(Auth::user());die();
		
		//$asociatie_id = getInputOrSession('asociatie_id');
		//View::share('asociatie_id', $asociatie_id);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		foreach (glob(app_path().'/Helpers/*.php') as $filename){
        	require_once($filename);
    	}
	}

}
