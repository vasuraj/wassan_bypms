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


	Route::post('farmer','FarmersController@store');
	Route::get('farmer/selectfarmer','FarmersController@selectFarmer');
	Route::get('farmer/getfarmersbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','FarmersController@getFarmersByLocation');
	Route::get('farmer/getfarmersrecordbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','FarmersController@getFarmersRecordByLocation');

	Route::get('farmer/all','FarmersController@getAll');
	Route::get('farmer/selective','FarmersController@selectiveFarmerView');
	Route::get('farmer/getselective/{state}/{district}/{mandal}/{mvk}/{panchayat}/{village}/{habitation}','FarmersController@getSelectiveFarmer');
	Route::resource('farmer','FarmersController');


	
	Route::get('ngo/addfarmers','NgosController@addFarmers');
	Route::post('ngo/storengofarmers','NgosController@storeNgoFarmers');
	Route::get('ngo/selective','NgosController@selectiveNgoView');
	Route::get('ngo/getselective/{state}/{district}/{mandal}/{mvk}/{panchayat}/{village}/{habitation}','NgosController@getSelectiveNgo');
	Route::get('ngo/getngosfarmers/{ngo_id}','NgosController@getNgosFarmers');
	Route::get('ngo/getngosbylocation/{state}/{district}/{mandal}/{village}/{select_type?}','NgosController@getNgosByLocation');
	Route::post('ngo/selectngo','NgosController@selectNgo');
	Route::get('ngo/destroy_farmer_link/{farmer_id}','NgosController@destroy_farmer_link');
	Route::get('ngo/ngo_profile_pdf/{ngo_id}','NgosController@ngo_profile_pdf');
	Route::get('ngo/change_password','NgosController@change_password');
	Route::post('ngo/change_password','NgosController@store_password');
	Route::get('ngo/check_password','NgosController@check_password');
	Route::get('ngo/delete/{ngo_id}','NgosController@destroy');
	Route::resource('ngo','NgosController');


	Route::resource('permissions', 'PermissionsController');
	Route::get('/role_permission', 'RolesPermissionsController@index');
	Route::post('/role_permission', 'RolesPermissionsController@store');

	Route::get('image/','ImagesController@index');
	Route::get('image/get_image/{filename}','ImagesController@get_image');
	Route::get('image/get_image/cropped/{filename}','ImagesController@get_image_cropped');
	Route::get('image/get_image/thumb/{filename}','ImagesController@get_image_thumb');
	Route::get('image/get_image_field_incharge/{ngo_id}','ImagesController@get_image_field_incharge');
	Route::get('image/get_image_ngo_head/{ngo_id}','ImagesController@get_image_ngo_head');

	Route::get('image/upload_profile_pic','ImagesController@upload_profile_pic');

	Route::post('image/profile_pic_store','ImagesController@profile_pic_store');

	Route::post('image/img_save_to_file','ImagesController@image_save_to_file');
	Route::post('image/img_crop_to_file','ImagesController@image_crop_to_file');
	// Route::match(['get','post'],'location/selectlocation/{module?}','LocationsController@selectLocation');
	Route::get('email/send','EmailsController@send');

	Route::POST('session/set_variable','SessionsController@set_variable');
	Route::post('seed_management/farmers_list','SeedManagementController@farmers_list');
	Route::get('seed_management/{form_name?}','SeedManagementController@index');
	
// seed purchase
	Route::post('seed_management/seed_purchaser/form','SeedManagementController@seed_purchaser_form');
	Route::post('seed_management/store_seed_purchaser/{transaction_id?}','SeedManagementController@store_seed_purchaser');
	Route::get('seed_management/seed_purchase/{transaction_id}/edit','SeedManagementController@seed_purchaser_form_edit');
	Route::get('seed_management/seed_purchase/{transaction_id}/delete','SeedManagementController@seed_purchaser_delete');


// rouging detials
	Route::post('seed_management/rouging/form','SeedManagementController@rouging_form');
	Route::post('seed_management/store_rouging/{rouging_id?}','SeedManagementController@store_rouging');
	Route::get('seed_management/rouging/{transaction_id}/edit','SeedManagementController@rouging_form_edit');
	Route::get('seed_management/rouging/{transaction_id}/delete','SeedManagementController@rouging_delete');

	Route::get('seed_management/report/{report_type}','SeedManagementController@get_report');
	Route::get('seed_management/get_report/seed_purchased/{state?}/{district?}/{mandal?}/{mvk?}/{panchayat?}/{village?}/{habitation?}','SeedManagementController@get_report_seed_purchased');
	Route::get('seed_management/get_report/rouging/{state?}/{district?}/{mandal?}/{mvk?}/{panchayat?}/{village?}/{habitation?}','SeedManagementController@get_report_rouging');

	
	



});




Route::group(['middleware' => ['auth', 'authorize'],'prefix'=>'locations'],function(){
    Route::get('/',function(){
        echo "hi";
    });
  	Route::get('/reset_location/{session_varibale_name}','LocationsController@reset_location');

    Route::get('/get_states','LocationsController@get_states');
    Route::get('/get_districts/{state_id}','LocationsController@get_districts');
    Route::get('/get_districts_json/{state_id}','LocationsController@get_districts_json');
    Route::get('/get_districts_dropdown/{state_id}','LocationsController@get_districts_dropdown');
    Route::get('/get_mandals_dropdown/{district_id}','LocationsController@get_mandals_dropdown');
    Route::get('/get_mvks/{mandal_id}','<LocationsController@get_mvk></LocationsController@get_mvk>s');

    Route::get('/get_mvks_dropdown/{mandal_id}','LocationsController@get_mvks_dropdown');
    Route::get('/get_mvk_panchayats_dropdown/{mvk_id}','LocationsController@get_mvk_panchayats_dropdown');

    
    Route::get('/get_panchayats_dropdown/{mandal_id}','LocationsController@get_panchayats_dropdown');
    Route::get('/get_villages_dropdown/{tahsil_id}','LocationsController@get_villages_dropdown');
    Route::get('/get_habitations_dropdown/{village_id}','LocationsController@get_habitations_dropdown');
    Route::get('/get_select_districts_dropdown/{state_id}','LocationsController@get_select_districts_dropdown');
    Route::get('/get_select_mandals_dropdown/{district_id}','LocationsController@get_select_mandals_dropdown');
    Route::get('/get_select_panchayats_dropdown/{mandal_id}','LocationsController@get_select_panchayats_dropdown');

    Route::get('/get_select_villages_dropdown/{tahsil_id}','LocationsController@get_select_villages_dropdown');
    Route::get('/locationdropdown/{div_id}','LocationsController@locationdropdown');
    Route::get('/locationdropdownmandal/{district_id}/{div_id}','LocationsController@locationDropdownMandal');
    Route::get('/locationdropdownvillage/{mandal_id}/{div_id}','LocationsController@locationDropdownVillage');
    Route::get('/view_mvk/{mvk_id?}','LocationsController@view_mvk');
    Route::get('/add_mvk/{mvk_id?}','LocationsController@add_mvk');
    Route::post('/add_mvk/{mvk_id?}','LocationsController@store_mvk');
    Route::get('/delete_mvk/{mvk_id}','LocationsController@delete_mvk');


    Route::get('/get_panchayt_multiselect/{mandal_id}','LocationsController@get_panchayt_multiselct');





});





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

]);

