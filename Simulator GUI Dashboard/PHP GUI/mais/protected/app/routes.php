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

/* Code Improvment By  mailbeez */
if (defined('CNF_MULTILANG') && CNF_MULTILANG == 1) {
    $lang = (Session::get('lang') != "" ? Session::get('lang') : CNF_LANG);
    App::setLocale($lang);
}
/* End Improvment mailbeez */

Route::controller('user', 'UserController'); 
Route::get('/', 'HomeController@index');
Route::controller('home', 'HomeController');
Route::controller('blog', 'BlogController');
include('pageroutes.php');
Route::group(array('before' => 'auth'), function() 
{
	/* CORE APPLICATION DONT DELETE IT */
	Route::controller('pages', 'PagesController');
	Route::controller('users', 'UsersController');
	Route::controller('groups', 'GroupsController');
	Route::controller('menu', 'MenuController');
	Route::controller('dashboard', 'DashboardController');
	Route::controller('module', 'ModuleController');
	Route::controller('config', 'ConfigController');
	Route::controller('logs', 'LogsController');
	Route::controller('blogadmin', 'BlogadminController');
	Route::controller('blogcategories', 'BlogcategoriesController');
	Route::controller('blogcomment', 'BlogcommentController');
	/* END CORE APPLICATION  */
	
	/* Dynamic Routers */
	include('moduleroutes.php');
});	
