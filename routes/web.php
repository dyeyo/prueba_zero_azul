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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home')->name('home');
    Route::get('/cursos', 'CoursesController@index')->name('courses');
    Route::post('/cursos/crear', 'CoursesController@store')->name('courses_new');
    Route::put('/cursos/update/{id}', 'CoursesController@update')->name('courses_update');
    Route::delete('/cursos/{id}', 'CoursesController@destroy')->name('courses_delete');
});
Auth::routes();

