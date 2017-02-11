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
Route::get('/attendance/dashboard','AttendanceController@index');
Route::get('/attendance/client-insert','AttendanceController@index');
Route::get('/attendance/edit','AttendanceController@edit');


/**
 * Basic Action Routes
 */
Route::get('/search/autocomplete', 'SearchController@autocomplete');
Route::get('/attendance/delete', 'AttendanceController@deleteAttendance');
Route::get('/attendance/class-type-delete', 'AttendanceController@deleteClassType');
Route::get('/attendance/add-class-type','AttendanceController@addClassType');


/**
 * Ajax Routes
 */

Route::get('/attendance/delete-success', 'AttendanceController@deleteSuccess');
Route::get('/attendance/graph', 'AttendanceController@graphNumbers');
Route::get('/attendance/addToClass','AttendanceController@addToClass');