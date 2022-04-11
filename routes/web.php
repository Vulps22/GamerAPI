<?php

use Illuminate\Support\Facades\View;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * View Routes
 */
Route::get('/', function()
{
   return View::make('pages.home');
});


/**
 * API Routes
 */

Route::get('/user/login', "AuthController@login");
Route::get('/user/scan/{id}', "GameController@scan");
Route::get('/games', "GameController@index");
Route::get('/posts/send/{game}/{user}/{desc}', "PostController@store");

