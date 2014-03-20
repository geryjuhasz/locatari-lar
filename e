[1mdiff --git a/CONTRIBUTING.md b/CONTRIBUTING.md[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/README.md b/README.md[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/commands/.gitkeep b/app/commands/.gitkeep[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/app.php b/app/config/app.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/auth.php b/app/config/auth.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/cache.php b/app/config/cache.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/compile.php b/app/config/compile.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/database.php b/app/config/database.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mindex 3c8e01c..bcbc0e7[m
[1m--- a/app/config/database.php[m
[1m+++ b/app/config/database.php[m
[36m@@ -57,7 +57,7 @@[m [mreturn array([m
 			'host'      => 'localhost',[m
 			'database'  => 'asociatiedb',[m
 			'username'  => 'root',[m
[31m-			'password'  => '',[m
[32m+[m			[32m'password'  => '123456',[m
 			'charset'   => 'utf8',[m
 			'collation' => 'utf8_unicode_ci',[m
 			'prefix'    => '',[m
[1mdiff --git a/app/config/mail.php b/app/config/mail.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/packages/.gitkeep b/app/config/packages/.gitkeep[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/queue.php b/app/config/queue.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/remote.php b/app/config/remote.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/session.php b/app/config/session.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/testing/cache.php b/app/config/testing/cache.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/testing/session.php b/app/config/testing/session.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/view.php b/app/config/view.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/config/workbench.php b/app/config/workbench.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/.gitkeep b/app/controllers/.gitkeep[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/AsociatiesController.php b/app/controllers/AsociatiesController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/BaseController.php b/app/controllers/BaseController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/BlocsController.php b/app/controllers/BlocsController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/Calcul_asociatiesController.php b/app/controllers/Calcul_asociatiesController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/CheltuielisController.php b/app/controllers/CheltuielisController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/ConsumsController.php b/app/controllers/ConsumsController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/Cost_locatarisController.php b/app/controllers/Cost_locatarisController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/HomeController.php b/app/controllers/HomeController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/LocatarisController.php b/app/controllers/LocatarisController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/controllers/ScarasController.php b/app/controllers/ScarasController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/.gitkeep b/app/database/migrations/.gitkeep[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204509_create_asociatie_table.php b/app/database/migrations/2014_02_27_204509_create_asociatie_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204509_create_bloc_table.php b/app/database/migrations/2014_02_27_204509_create_bloc_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204509_create_calcul_asociatie_table.php b/app/database/migrations/2014_02_27_204509_create_calcul_asociatie_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204509_create_cheltuieli_table.php b/app/database/migrations/2014_02_27_204509_create_cheltuieli_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204509_create_consum_table.php b/app/database/migrations/2014_02_27_204509_create_consum_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_cost_locatari_table.php b/app/database/migrations/2014_02_27_204510_create_cost_locatari_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_locatari_table.php b/app/database/migrations/2014_02_27_204510_create_locatari_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_scara_table.php b/app/database/migrations/2014_02_27_204510_create_scara_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_tipcalculrepartitie_table.php b/app/database/migrations/2014_02_27_204510_create_tipcalculrepartitie_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_tipcheltuieli_table.php b/app/database/migrations/2014_02_27_204510_create_tipcheltuieli_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_tipconsum_table.php b/app/database/migrations/2014_02_27_204510_create_tipconsum_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_tipincapere_table.php b/app/database/migrations/2014_02_27_204510_create_tipincapere_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_02_27_204510_create_tiprepartitie_table.php b/app/database/migrations/2014_02_27_204510_create_tiprepartitie_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_07_185318_alter_scara.php b/app/database/migrations/2014_03_07_185318_alter_scara.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_07_191212_create_scaras_table.php b/app/database/migrations/2014_03_07_191212_create_scaras_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_07_193655_create_locataris_table.php b/app/database/migrations/2014_03_07_193655_create_locataris_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_08_184850_create_calcul_asociaties_table.php b/app/database/migrations/2014_03_08_184850_create_calcul_asociaties_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mindex 340b5fa..4a0cb65[m
[1m--- a/app/database/migrations/2014_03_08_184850_create_calcul_asociaties_table.php[m
[1m+++ b/app/database/migrations/2014_03_08_184850_create_calcul_asociaties_table.php[m
[36m@@ -14,7 +14,7 @@[m [mclass CreateCalculAsociatiesTable extends Migration {[m
 	{[m
 		Schema::create('calcul_asociaties', function(Blueprint $table) {[m
 			$table->increments('id');[m
[31m-			$table->integeredit('asociatie_id');[m
[32m+[m			[32m$table->integer('asociatie_id');[m
 			$table->timestamps();[m
 		});[m
 	}[m
[1mdiff --git a/app/database/migrations/2014_03_09_073338_create_consums_table.php b/app/database/migrations/2014_03_09_073338_create_consums_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_09_073419_create_celtuielis_table.php b/app/database/migrations/2014_03_09_073419_create_celtuielis_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_09_073429_create_cheltuielis_table.php b/app/database/migrations/2014_03_09_073429_create_cheltuielis_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/migrations/2014_03_09_073603_create_cost_locataris_table.php b/app/database/migrations/2014_03_09_073603_create_cost_locataris_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/production.sqlite b/app/database/production.sqlite[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/.gitkeep b/app/database/seeds/.gitkeep[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/AsociatieTableSeeder.php b/app/database/seeds/AsociatieTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/AsociatiesTableSeeder.php b/app/database/seeds/AsociatiesTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/BlocTableSeeder.php b/app/database/seeds/BlocTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/Calcul_asociatiesTableSeeder.php b/app/database/seeds/Calcul_asociatiesTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/CeltuielisTableSeeder.php b/app/database/seeds/CeltuielisTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/CheltuielisTableSeeder.php b/app/database/seeds/CheltuielisTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/ConsumsTableSeeder.php b/app/database/seeds/ConsumsTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/Cost_locatarisTableSeeder.php b/app/database/seeds/Cost_locatarisTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/DatabaseSeeder.php b/app/database/seeds/DatabaseSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mindex b717772..595c1f1[m
[1m--- a/app/database/seeds/DatabaseSeeder.php[m
[1m+++ b/app/database/seeds/DatabaseSeeder.php[m
[36m@@ -28,6 +28,7 @@[m [mclass DatabaseSeeder extends Seeder {[m
 		$this->call('CeltuielisTableSeeder');[m
 		$this->call('CheltuielisTableSeeder');[m
 		$this->call('Cost_locatarisTableSeeder');[m
[32m+[m[32m                $this->call('UserTableSeeder');[m
 	}[m
 [m
 }[m
\ No newline at end of file[m
[1mdiff --git a/app/database/seeds/LocatarisTableSeeder.php b/app/database/seeds/LocatarisTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/ScaraTableSeeder.php b/app/database/seeds/ScaraTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/ScarasTableSeeder.php b/app/database/seeds/ScarasTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/TipcalculrepartitieTableSeeder.php b/app/database/seeds/TipcalculrepartitieTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/TipcheltuieliTableSeeder.php b/app/database/seeds/TipcheltuieliTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/TipconsumTableSeeder.php b/app/database/seeds/TipconsumTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/TipincapereTableSeeder.php b/app/database/seeds/TipincapereTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/database/seeds/TiprepartitieTableSeeder.php b/app/database/seeds/TiprepartitieTableSeeder.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/filters.php b/app/filters.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mindex 0da6aa0..f94ca5b[m
[1m--- a/app/filters.php[m
[1m+++ b/app/filters.php[m
[36m@@ -108,4 +108,16 @@[m [mRoute::filter('nav', function() {[m
 //	}[m
 	View::share('nav_left_active', '');[m
 	View::share('nav_top_active', '');[m
[32m+[m[32m});[m
[32m+[m
[32m+[m[32mRoute::filter('backend_auth', function() {[m
[32m+[m[41m    [m
[32m+[m[32m        if (Auth::guest()) {[m
[32m+[m[32m            //Save requested URL in order to redirect afterwards[m
[32m+[m[32m            Session::put('redir_url', URL::current());[m
[32m+[m[32m                return Redirect::action('AdminsController@login');[m
[32m+[m[32m        }[m
[32m+[m	[32mif(!Auth::check()) {[m
[32m+[m		[32mreturn Redirect::action('AdminsController@login');[m
[32m+[m	[32m}[m
 });[m
\ No newline at end of file[m
[1mdiff --git a/app/lang/en/pagination.php b/app/lang/en/pagination.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/lang/en/reminders.php b/app/lang/en/reminders.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/lang/en/validation.php b/app/lang/en/validation.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Asociatie.php b/app/models/Asociatie.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Bloc.php b/app/models/Bloc.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Calcul_asociatie.php b/app/models/Calcul_asociatie.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Cheltuieli.php b/app/models/Cheltuieli.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Consum.php b/app/models/Consum.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Cost_locatari.php b/app/models/Cost_locatari.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Locatari.php b/app/models/Locatari.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Scara.php b/app/models/Scara.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Tipcalculrepartitie.php b/app/models/Tipcalculrepartitie.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Tipcheltuieli.php b/app/models/Tipcheltuieli.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Tipconsum.php b/app/models/Tipconsum.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Tipincapere.php b/app/models/Tipincapere.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/Tiprepartitie.php b/app/models/Tiprepartitie.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/models/User.php b/app/models/User.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/routes.php b/app/routes.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mindex bd0276d..da920b8[m
[1m--- a/app/routes.php[m
[1m+++ b/app/routes.php[m
[36m@@ -26,10 +26,10 @@[m [mRoute::group(array('before' => 'backend_auth|nav'), function() {[m
         Route::resource('consums', 'ConsumsController');[m
         Route::resource('cheltuielis', 'CheltuielisController');[m
         Route::resource('cost_locataris', 'Cost_locatarisController');[m
[32m+[m[41m        [m
[32m+[m[32m        Route::get('logout_admin', 'AdminsController@logout');[m
 [m
 });[m
 [m
[31m-[m
[31m-[m
[31m-[m
[31m-[m
[32m+[m[32mRoute::get('login_admin', array('as' => 'login', 'uses' => 'AdminsController@loginForm'));[m
[32m+[m[32mRoute::post('login_admin', array('as' => 'login', 'uses' => 'AdminsController@login'));[m
[1mdiff --git a/app/start/artisan.php b/app/start/artisan.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/start/global.php b/app/start/globa