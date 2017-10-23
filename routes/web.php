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

Route::get('/', 'HomeController@index');

Route::get('admin/login','Admin\LoginController@index');
Route::get('admin',function(){
    return redirect('admin/login');
});
Route::get('admin/auth',function(){
    return redirect('admin/login');
});

Route::post('admin/auth', [
    'uses' => 'Admin\AuthController@index',
    'as' => 'admin.auth'
]);

Route::get('admin/logout', [
    'uses' => 'Admin\LogoutController@index',
    'as' => 'admin.logout'
]);

Route::get('admin/dashboard', [
    'uses' => 'Admin\DashboardController@index',
    'as' => 'admin.dashboard'
]);

// Administrator Pharmacies routes.
Route::get('admin/pharmacies', [
    'uses' => 'Admin\PharmaciesController@index',
    'as' => 'admin.pharmacies'
]);

Route::get('admin/pharmacies/view/{id}', [
    'uses' => 'Admin\PharmaciesController@view',
    'as' => 'admin.pharmacies.view'
]);

Route::get('admin/pharmacies/edit/{id}', [
    'uses' => 'Admin\PharmaciesController@edit',
    'as' => 'admin.pharmacies.edit'
]);

Route::get('admin/pharmacies/delete/{id}', [
    'uses' => 'Admin\PharmaciesController@delete',
    'as' => 'admin.pharmacies.delete'
]);

Route::post('admin/pharmacies', [
    'uses' => 'Admin\PharmaciesController@update',
    'as' => 'admin.pharmacies.update'
]);

Route::post('admin/pharmacies/create', [
    'uses' => 'Admin\PharmaciesController@create',
    'as' => 'admin.pharmacies.create'
]);

// Administrator Verifications routes.
Route::get('admin/verifications', [
    'uses' => 'Admin\VerificationsController@index',
    'as' => 'admin.verifications'
]);

// Administrator Reports routes.
Route::get('admin/reports', [
    'uses' => 'Admin\ReportsController@index',
    'as' => 'admin.reports'
]);

Route::get('admin/reports/view/{id}', [
    'uses' => 'Admin\ReportsController@view',
    'as' => 'admin.reports.view'
]);

Route::get('admin/reports/edit/{id}', [
    'uses' => 'Admin\ReportsController@edit',
    'as' => 'admin.reports.edit'
]);

Route::get('admin/reports/delete/{id}', [
    'uses' => 'Admin\ReportsController@delete',
    'as' => 'admin.reports.delete'
]);

Route::post('admin/pharmacies', [
    'uses' => 'Admin\PharmaciesController@update',
    'as' => 'admin.pharmacies.update'
]);

Route::post('admin/reports', [
    'uses' => 'Admin\ReportsController@update',
    'as' => 'admin.reports.update'
]);

// Administrator Users routes.
Route::get('admin/users', [
    'uses' => 'Admin\UsersController@index',
    'as' => 'admin.users'
]);

Route::get('admin/users/view/{id}', [
    'uses' => 'Admin\UsersController@view',
    'as' => 'admin.users.view'
]);

Route::get('admin/users/edit/{id}', [
    'uses' => 'Admin\UsersController@edit',
    'as' => 'admin.users.edit'
]);

Route::get('admin/users/delete/{id}', [
    'uses' => 'Admin\UsersController@delete',
    'as' => 'admin.users.delete'
]);

Route::post('admin/users', [
    'uses' => 'Admin\UsersController@update',
    'as' => 'admin.users.update'
]);

Route::post('admin/users/create', [
    'uses' => 'Admin\UsersController@create',
    'as' => 'admin.users.create'
]);

// Administrator Dispensers routes.
Route::get('admin/dispensers', [
    'uses' => 'Admin\DispensersController@index',
    'as' => 'admin.dispensers'
]);

Route::get('admin/dispensers/view/{id}', [
    'uses' => 'Admin\DispensersController@view',
    'as' => 'admin.dispensers.view'
]);

Route::get('admin/dispensers/edit/{id}', [
    'uses' => 'Admin\DispensersController@edit',
    'as' => 'admin.dispensers.edit'
]);

Route::get('admin/dispensers/delete/{id}', [
    'uses' => 'Admin\DispensersController@delete',
    'as' => 'admin.dispensers.delete'
]);

Route::post('admin/dispensers', [
    'uses' => 'Admin\DispensersController@update',
    'as' => 'admin.dispensers.update'
]);

Route::post('admin/dispensers/create', [
    'uses' => 'Admin\DispensersController@create',
    'as' => 'admin.dispensers.create'
]);

// Administrator Addos routes.
Route::get('admin/addos', [
    'uses' => 'Admin\AddosController@index',
    'as' => 'admin.addos'
]);

Route::get('admin/addos/view/{id}', [
    'uses' => 'Admin\AddosController@view',
    'as' => 'admin.addos.view'
]);

Route::get('admin/addos/edit/{id}', [
    'uses' => 'Admin\AddosController@edit',
    'as' => 'admin.addos.edit'
]);

Route::get('admin/addos/delete/{id}', [
    'uses' => 'Admin\AddosController@delete',
    'as' => 'admin.addos.delete'
]);

Route::post('admin/addos', [
    'uses' => 'Admin\AddosController@update',
    'as' => 'admin.addos.update'
]);

Route::post('admin/addos/create', [
    'uses' => 'Admin\AddosController@create',
    'as' => 'admin.addos.create'
]);

// Administrator Premises routes.
Route::get('admin/premises', [
    'uses' => 'Admin\PremisesController@index',
    'as' => 'admin.premises'
]);

Route::get('admin/premises/view/{id}', [
    'uses' => 'Admin\PremisesController@view',
    'as' => 'admin.premises.view'
]);

Route::get('admin/premises/edit/{id}', [
    'uses' => 'Admin\PremisesController@edit',
    'as' => 'admin.premises.edit'
]);

Route::get('admin/premises/delete/{id}', [
    'uses' => 'Admin\PremisesController@delete',
    'as' => 'admin.premises.delete'
]);

Route::post('admin/premises', [
    'uses' => 'Admin\PremisesController@update',
    'as' => 'admin.premises.update'
]);

Route::post('admin/premises/create', [
    'uses' => 'Admin\PremisesController@create',
    'as' => 'admin.premises.create'
]);