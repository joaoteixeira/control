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
Route::get('/', 'Admin\AdminController@index')->middleware('auth');
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
Route::post('activities/check-user', 'ActivitiesController@checkUser');

Route::get('controls', 'ActivitiesController@control');

use Adldap\Laravel\Facades\Adldap;

Route::get('test', function() {
//    $user = Adldap::search()->users()->find('2298760');

//    $user = Adldap::search()->where('samaccountname', '=', '84196033253')->get();
//    $adldap = new Adldap();

//    $test = Adldap::connect('2298760', '2298760', '1nbat4@2005');
//    $user = Adldap::search()->where(['samaccountname' => '2298760', 'userPassword' => '1nbat4@2005'])->get();

    if(Adldap::auth()->attempt('83807551204@ifro.local', 'machineCO')) {
//        $user = Adldap::search()->users()->find('2298760');
        $user = Adldap::search()->where('samaccountname', '=', '84196033253')->first();
//        dd($user);

        if($user->isActive()) {
            return 'true';
        } else {
            return 'false';
        }

        return $key;
//        return implode('-', $user->useraccountcontrol);
    } else {
        return 'no_ok';
    }
});
