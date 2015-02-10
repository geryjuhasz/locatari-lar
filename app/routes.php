<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//    return View::make('homepage');
//});



Route::resource('/', 'Frontend@index');

Route::group(array('before' => 'backend_auth|nav'), function() {
	Route::resource('blocs', 'BlocsController');
        Route::resource('asociaties', 'AsociatiesController');
	Route::resource('scaras', 'ScarasController');
        Route::resource('locataris', 'LocatarisController');
        Route::resource('calcul_asociaties', 'Calcul_asociatiesController');
        Route::resource('consums', 'ConsumsController');
        Route::resource('cheltuielis', 'CheltuielisController');
        Route::resource('cost_locataris', 'Cost_locatarisController');
        Route::resource('asociatie_consums', 'Asociatie_consumsController');
        Route::resource('admins', 'AdminsController');
        Route::resource('dashboard', 'DashboardController');
        Route::get('logout_admin', 'AdminsController@logout');
});



Route::get('login_admin', array('as' => 'login', 'uses' => 'AdminsController@loginForm'));
Route::post('login_admin', array('as' => 'login', 'uses' => 'AdminsController@login'));

