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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes(['reset'=>false]);

Route::get('/','TaskController@index')->name('task.index');
Route::post('add','TaskController@add')->name('task.add');
Route::post('edit/{id}','TaskController@edit')->name('task.edit');
Route::get('list','TaskController@list')->name('task.list');
Route::put('delete/{id}','TaskController@delete')->name('task.delete');
Route::put('close/{id}','TaskController@close')->name('task.close');

