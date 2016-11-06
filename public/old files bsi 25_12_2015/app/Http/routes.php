<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');

Route::get('/dashboard', [
	'as' => 'dashboard',
	'uses' => 'DashboardController@index',
	'middleware' => 'auth'
]);


Route::group(['middleware' => ['auth', 'authorize']], function(){

	Route::any('/session/setFormDatabase/{form_database}/{url_to_return_to}','SessionsController@setFormDatabase');

	Route::resource('users', 'UsersController');
	Route::resource('roles', 'RolesController');
	
	Route::get('farmer/selectfarmer','FarmersController@selectFarmer');
	Route::get('farmer/getfarmersbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','FarmersController@getFarmersByLocation');
	Route::get('farmer/getfarmersrecordbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','FarmersController@getFarmersRecordByLocation');

	Route::get('farmer/all','FarmersController@getAll');
	Route::get('farmer/selective','FarmersController@selectiveFarmerView');
	Route::get('farmer/getselective/{state}/{district}/{mandal}/{village}','FarmersController@getSelectiveFarmer');
	Route::resource('farmer','FarmersController');
	
	
	Route::get('ngo/addfarmers','NgosController@addFarmers');
	Route::post('ngo/storengofarmers','NgosController@storeNgoFarmers');
	Route::get('ngo/selective','NgosController@selectiveNgoView');
	Route::get('ngo/getselective/{state}/{district}/{mandal}/{village}','NgosController@getSelectiveNgo');
	Route::get('ngo/getngosfarmers/{ngo_id}','NgosController@getNgosFarmers');
	Route::get('ngo/getngosbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','NgosController@getNgosByLocation');
	Route::post('ngo/selectngo','NgosController@selectNgo');
	Route::get('ngo/destroy_farmer_link/{farmer_id}','NgosController@destroy_farmer_link');
	Route::resource('ngo','NgosController');


	Route::resource('permissions', 'PermissionsController');
	Route::get('/role_permission', 'RolesPermissionsController@index');
	Route::post('/role_permission', 'RolesPermissionsController@store');
	


	// Route::match(['get','post'],'location/selectlocation/{module?}','LocationsController@selectLocation');


});




Route::group(['prefix'=>'locations'],function(){
    Route::get('/',function(){
        echo "hi";
    });

    Route::get('/get_states','LocationsController@get_states');
    Route::get('/get_districts/{state_id}','LocationsController@get_districts');
    Route::get('/get_districts_json/{state_id}','LocationsController@get_districts_json');
    Route::get('/get_districts_dropdown/{state_id}','LocationsController@get_districts_dropdown');
    Route::get('/get_mandals_dropdown/{district_id}','LocationsController@get_mandals_dropdown');
    Route::get('/get_villages_dropdown/{tahsil_id}','LocationsController@get_villages_dropdown');
    Route::get('/get_select_districts_dropdown/{state_id}','LocationsController@get_select_districts_dropdown');
    Route::get('/get_select_mandals_dropdown/{district_id}','LocationsController@get_select_mandals_dropdown');
    Route::get('/get_select_villages_dropdown/{tahsil_id}','LocationsController@get_select_villages_dropdown');
    Route::get('/locationdropdown/{div_id}','LocationsController@locationdropdown');
    Route::get('/locationdropdownmandal/{district_id}/{div_id}','LocationsController@locationDropdownMandal');
    Route::get('/locationdropdownvillage/{mandal_id}/{div_id}','LocationsController@locationDropdownVillage');

});





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

]);


