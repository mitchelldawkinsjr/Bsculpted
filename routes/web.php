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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');

/**
 * Dashboard sidebar Routes
 */
Route::get('/attendance','AttendanceController@index');
Route::get('/attendance/addToClass','AttendanceController@addToClass');
Route::get('/attend','AttendanceController@index');


Route::get('/search/autocomplete', 'SearchController@autocomplete');

/**
 * Ajax
 */
Route::get('/attend-delete', 'AttendanceController@deleteAttendance');
Route::get('/class-type-delete', 'AttendanceController@deleteClassType');
Route::get('/attend-delete-success', 'AttendanceController@deleteSuccess');

Route::get('/attendance/add-class','AttendanceController@AddClass');