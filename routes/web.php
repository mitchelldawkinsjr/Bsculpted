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


\App\Common\Common::globalXssClean();

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/contact', 'EmailController@showForm');
    Route::post('/contact', 'EmailController@sendContactInfo');

  Route::get('/logout', 'Auth\LoginController@logout');
  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index');

  /**
   * Attendance Module
   */
  Route::get('/attendance/dashboard','AttendanceController@index');
  Route::get('/attendance/client-insert','AttendanceController@index');
  Route::get('/attendance/edit','AttendanceController@edit');
  Route::get('/attendance/delete', 'AttendanceController@deleteAttendance');
  Route::get('/attendance/class-type-delete', 'AttendanceController@deleteClassType');
  Route::get('/attendance/add-class-type','AttendanceController@addClassType');

  /**
   * Clients Module
   */
  Route::get('/clients/dashboard','ClientsController@index');
  Route::get('/clients/delete-client','ClientsController@delete');
  Route::get('/clients/edit-client','ClientsController@edit');
  Route::get('/clients/add','ClientsController@add');


  /**
   * Basic Action Routes
   */
  Route::get('/search/autocomplete', 'SearchController@autocomplete');


  /**
   * Ajax Routes
   */
  Route::get('/attendance/delete-success', 'AttendanceController@deleteSuccess');
  Route::get('/attendance/graph', 'AttendanceController@graphNumbers');
  Route::get('/attendance/addToClass','AttendanceController@addToClass');

});
