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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('v1/auth/login', 'HkyController');
Route::resource('v1/auth/logout', 'LogoutController');
Route::get('v1/ueser','LogoutController@show');

/*
 * 地点的创建，查找，删除
 * http://localhost:1052/v1/place?token=21232f297a57a5a743894a0e4a801fc3  后面的一串数字是登录后的api_token
 * http://localhost:1052/v1/place/5?token=21232f297a57a5a743894a0e4a801fc3  查找地点
 * */
Route::get('v1/place','PlaceController@index')->name('home');
Route::get('v1/place/{id}','PlaceController@show');
Route::post('v1/place','PlaceController@store');
Route::resource('v1/place','PlaceController');
Route::resource('v1/place','PlaceUpdateController');

/*
 *时间表搜索删除
 * */
Route::post('v1/schedule','SchedulesController@store');

Route::get('v1/route/search/{form_place_id}/{to_place_id}/{departure_time}','SearchController@show');
Route::post('v1/route/selection','SearchController@store');