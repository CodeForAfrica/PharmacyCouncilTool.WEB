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

Route::get('admin/logout','Admin\LogoutController@index');

Route::get('admin/dashboard', [
    'uses' => 'Admin\DashboardController@index',
    'as' => 'admin.dashboard'
]);

Route::get('admin/pharmacies', [
    'uses' => 'Admin\PharmaciesController@index',
    'as' => 'admin.pharmacies'
]);

Route::get('admin/verifications', [
    'uses' => 'Admin\VerificationsController@index',
    'as' => 'admin.verifications'
]);

Route::get('admin/reports', [
    'uses' => 'Admin\ReportsController@index',
    'as' => 'admin.reports'
]);

Route::get('admin/users', [
    'uses' => 'Admin\UsersController@index',
    'as' => 'admin.users'
]);