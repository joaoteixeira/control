<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//    return view('welcome');
// });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Admin\AdminController@index');
// Route::get('/', function () {
//   return redirect()->route('activities');
// });



Route::get('admin', 'Admin\AdminController@index')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('users', 'Admin\UsersController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

});

Route::resource('campi', 'CampiController');
Route::resource('rooms', 'RoomsController');
Route::resource('keys', 'KeysController');
Route::post('keys/print', 'KeysController@print');
Route::resource('people', 'PeopleController');

Route::resource('activities', 'ActivitiesController');
Route::post('activities/take', 'ActivitiesController@take');
Route::post('activities/back', 'ActivitiesController@back');

Route::get('controls', 'ActivitiesController@control');   
