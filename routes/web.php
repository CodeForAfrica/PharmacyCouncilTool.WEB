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

Route::get('admin/dashboard','Admin\DashboardController@index');