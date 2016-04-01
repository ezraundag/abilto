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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...



Route::get('/user', 'UserController@index');
Route::patch('/user', 'UserController@update');
Route::get('/home', 'HomeController@index');
Route::get('/forum', 'ForumController@index');
Route::post('/forum', 'ForumController@create');
Route::get('/post/{post}', 'PostController@index');
Route::post('/post/{post}', 'PostController@comment');
Route::auth();


