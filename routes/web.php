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

// Administrator Dashboard routes.
Route::get('admin/dashboard', [
    'uses' => 'Admin\DashboardController@index',
    'as' => 'admin.dashboard'
]);

Route::get('admin/dashboard/getdispensersdata', [
    'uses' => 'Admin\DashboardController@getDispensersData',
    'as' => 'admin.dashboard.getdispensersdata'
]);

Route::get('admin/dashboard/getaddosdata', [
    'uses' => 'Admin\DashboardController@getAddosData',
    'as' => 'admin.dashboard.getaddosdata'
]);

Route::get('admin/dashboard/getpersonnelsdata', [
    'uses' => 'Admin\DashboardController@getPersonnelsData',
    'as' => 'admin.dashboard.getpersonnelsdata'
]);

Route::get('admin/dashboard/getpharmaciesdata', [
    'uses' => 'Admin\DashboardController@getPharmaciesData',
    'as' => 'admin.dashboard.getpharmaciesdata'
]);

Route::get('admin/dashboard/getownersdata', [
    'uses' => 'Admin\DashboardController@getOwnersData',
    'as' => 'admin.dashboard.getownersdata'
]);

Route::get('admin/dashboard/getreportsdata', [
    'uses' => 'Admin\DashboardController@getReportsData',
    'as' => 'admin.dashboard.getreportsdata'
]);

Route::get('admin/dashboard/getattendancesdata', [
    'uses' => 'Admin\DashboardController@getAttendancesData',
    'as' => 'admin.dashboard.getattendancesdata'
]);

Route::get('admin/dashboard/getusersdata', [
    'uses' => 'Admin\DashboardController@getUsersData',
    'as' => 'admin.dashboard.getusersdata'
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

Route::post('admin/pharmacies/import', [
    'uses' => 'Admin\PharmaciesController@import',
    'as' => 'admin.pharmacies.import'
]);

Route::post('admin/pharmacies/datatable', [
    'uses' => 'Admin\PharmaciesController@datatable',
    'as' => 'admin.pharmacies.datatable'
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

Route::post('admin/dispensers/datatable', [
    'uses' => 'Admin\DispensersController@datatable',
    'as' => 'admin.dispensers.datatable'
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

// Administrator Owners routes.
Route::get('admin/owners', [
    'uses' => 'Admin\OwnersController@index',
    'as' => 'admin.owners'
]);

Route::get('admin/owners/view/{id}', [
    'uses' => 'Admin\OwnersController@view',
    'as' => 'admin.owners.view'
]);

Route::get('admin/owners/edit/{id}', [
    'uses' => 'Admin\OwnersController@edit',
    'as' => 'admin.owners.edit'
]);

Route::get('admin/owners/delete/{id}', [
    'uses' => 'Admin\OwnersController@delete',
    'as' => 'admin.owners.delete'
]);

Route::post('admin/owners', [
    'uses' => 'Admin\OwnersController@update',
    'as' => 'admin.owners.update'
]);

Route::post('admin/owners/create', [
    'uses' => 'Admin\OwnersController@create',
    'as' => 'admin.owners.create'
]);

Route::post('admin/owners/datatable', [
    'uses' => 'Admin\OwnersController@datatable',
    'as' => 'admin.owners.datatable'
]);

// Administrator Personnels routes.
Route::get('admin/personnel', [
    'uses' => 'Admin\PersonnelController@index',
    'as' => 'admin.personnel'
]);

Route::get('admin/personnel/view/{id}', [
    'uses' => 'Admin\PersonnelController@view',
    'as' => 'admin.personnel.view'
]);

Route::get('admin/personnel/edit/{id}', [
    'uses' => 'Admin\PersonnelController@edit',
    'as' => 'admin.personnel.edit'
]);

Route::get('admin/personnel/delete/{id}', [
    'uses' => 'Admin\PersonnelController@delete',
    'as' => 'admin.personnel.delete'
]);

Route::post('admin/personnel', [
    'uses' => 'Admin\PersonnelController@update',
    'as' => 'admin.personnel.update'
]);

Route::post('admin/personnel/create', [
    'uses' => 'Admin\PersonnelController@create',
    'as' => 'admin.personnel.create'
]);

Route::post('admin/personnel/datatable', [
    'uses' => 'Admin\PersonnelController@datatable',
    'as' => 'admin.personnel.datatable'
]);

// Administrator Attendances routes.
Route::get('admin/attendances', [
    'uses' => 'Admin\AttendancesController@index',
    'as' => 'admin.attendances'
]);

Route::get('admin/attendances/view/{id}', [
    'uses' => 'Admin\AttendancesController@view',
    'as' => 'admin.attendances.view'
]);

Route::get('admin/attendances/edit/{id}', [
    'uses' => 'Admin\AttendancesController@edit',
    'as' => 'admin.attendances.edit'
]);

Route::get('admin/attendances/delete/{id}', [
    'uses' => 'Admin\AttendancesController@delete',
    'as' => 'admin.attendances.delete'
]);

Route::post('admin/attendances', [
    'uses' => 'Admin\AttendancesController@update',
    'as' => 'admin.attendances.update'
]);

Route::post('admin/attendances/create', [
    'uses' => 'Admin\AttendancesController@create',
    'as' => 'admin.attendances.create'
]);

// Adding new owner
Route::get('admin/operations/addowner', 'Admin\OperationsController@addOwner');
Route::get('admin/operations/addpersonnel', 'Admin\OperationsController@addPersonnel');
Route::get('admin/operations/getdistricts', 'Admin\OperationsController@getDistricts');
Route::get('admin/operations/getwards', 'Admin\OperationsController@getWards');

// Language route
Route::get('/switchlanguage', [
    'as' => 'switchlanguage',
    'uses' => 'LanguageController@index'
]);