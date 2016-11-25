<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class MacroServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		foreach (glob(base_path("resources/macros/*.macro.php")) as $filename) {
        	require_once($filename);
    	}
		//foreach(File::glob(app_path() .'/Library/macros/*.php') as $macro) require $macro;
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
