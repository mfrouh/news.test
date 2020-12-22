<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::resource('/users','UserController');
Route::resource('/articles','ArticleController');
Route::resource('/categories','CategoryController');
Route::resource('/roles','RoleController');
Route::resource('/permissions','PermissionController');
Route::get('/setting','SettingController@index');
Route::post('/setting','SettingController@setting');
Auth::routes();
Route::get('/dashboard','DashboardController@dashboard');
Route::get('/change-password','DashboardController@change_password');
Route::post('/change-password','DashboardController@post_change_password');
Route::get('/profile-setting','DashboardController@profile_setting');
Route::post('/profile-setting','DashboardController@post_profile_setting');
Route::post('/role_permissions','RoleController@role_permissions');
Route::post('/user_permissions','UserController@user_permissions');
Route::get('/writers','UserController@writers');
Route::get('/writers/create','UserController@createwrite');
Route::post('/writers','UserController@storewrite');
Route::get('/supervisors','UserController@supervisors');
Route::get('/subscribers','UserController@subscribers');
Route::get('/{page}','SettingController@style');
