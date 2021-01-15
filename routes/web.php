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

Route::get('/', 'QuestionController@index');
Route::resource('question', 'QuestionController');
Route::resource('answer', 'AnswerController');
Route::get('answer/bestanswer/{id}', 'AnswerController@bestanswer');

Auth::routes();

Route::get('/user/{id}', 'UserController@show')->middleware('auth');
Route::get('/user/{id}/edit', 'UserController@edit')->middleware('auth');
Route::put('/user/{id}', 'UserController@update')->middleware('auth');
Route::delete('/user/{id}', 'UserController@destroy')->middleware('auth');
