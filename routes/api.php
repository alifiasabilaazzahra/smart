<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {

	// Product Routes
    Route::post('product/get', 'API\REST\ProductController@index');
    Route::post('product','API\REST\ProductController@store');
    Route::put('product','API\REST\ProductController@update');
    Route::delete('product','API\REST\ProductController@delete');

    // Siswa Routes
    Route::get('siswa/get','SiswaController@index');
    Route::post('siswa','SiswaController@store');
    Route::put('siswa','SiswaController@update');
    Route::delete('siswa','SiswaController@delete');

    // Student Routes

    Route::get('student/get', 'API\REST\StudentController@index');
    Route::get('student/trash', 'API\REST\StudentController@trash');
    Route::get('student/get/{id}', 'API\REST\StudentController@get_one');
    Route::post('student','API\REST\StudentController@store');
    Route::put('student','API\REST\StudentController@update');
    Route::put('student/restore','API\REST\StudentController@restore');
    Route::delete('student','API\REST\StudentController@delete');
    Route::delete('student/trash','API\REST\StudentController@delete_permanent');

    //Student Trash
    
});
