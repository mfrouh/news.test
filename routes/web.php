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
Route::resource('/roles','Backend\RoleController');
Route::resource('/permissions','Backend\PermissionController');
Route::resource('/users','Backend\UserController');
Route::resource('/categories','Backend\CategoryController');
Route::resource('/articles','Backend\ArticleController');
Route::post('/role_permissions','Backend\RoleController@role_permissions');
Route::post('/user_permissions','Backend\UserController@user_permissions');
// setting
Route::get('/setting','Backend\SettingController@index');
Route::post('/setting','Backend\SettingController@setting');
Route::get('/change-password','Backend\DashboardController@change_password');
Route::post('/change-password','Backend\DashboardController@post_change_password');
Route::get('/profile-setting','Backend\DashboardController@profile_setting');
Route::post('/profile-setting','Backend\DashboardController@post_profile_setting');
//dashboard
Route::get('/dashboard','Backend\DashboardController@dashboard');
//writers
Route::get('/writers','Backend\UserController@writers');
Route::get('/writers/create','Backend\UserController@createwrite');
Route::post('/writers','Backend\UserController@storewrite');
Route::get('/supervisors','Backend\UserController@supervisors');
Route::get('/subscribers','Backend\UserController@subscribers');

Route::get('/myarticles','Backend\ArticleController@myarticles');
Route::delete('/writercategory','Backend\UserController@writercategory');
Route::post('/categories/active','Backend\CategoryController@active');
Route::post('/categories/inactive','Backend\CategoryController@inactive');
Route::post('/articles/publish','Backend\ArticleController@publish');
Route::post('/articles/unpublish','Backend\ArticleController@unpublish');
Route::get('/categorywriter','Backend\SupervisorController@categorywriter');
Route::post('/categorywriter','Backend\SupervisorController@postcategorywriter');
Auth::routes();
Route::get('/{page}','Backend\SettingController@style');
