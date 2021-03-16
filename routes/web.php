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

Route::get('/', ['as' => 'get-user-login', 'uses' => 'HomeController@getUserLogin']);

Route::post('login', ['as' => 'post-user-login', 'uses' => 'HomeController@postUserLogin']);

Route::post('create-user', ['as' => 'post-create-user', 'uses' => 'HomeController@postCreateUser']);

Route::get('index', ['as' => 'get-user-index', 'uses' => 'HomeController@getUserIndex']);

Route::post('add-address', ['as' => 'post-add-address', 'uses' => 'HomeController@postAddAddress']);

Route::post('update-address', ['as' => 'post-update-address', 'uses' => 'HomeController@postUpdateAddress']);

Route::post('address-status', ['as' => 'post-address-status', 'uses' => 'HomeController@postStatusAddress']);

Route::post('view-map', ['as' => 'post-view-map', 'uses' => 'HomeController@postViewMap']);

Route::get('logout', ['as' => 'user-logout','uses' => 'HomeController@getUserLogout']);
