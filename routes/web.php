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

app(App\Additional\LandingRoutes::class)->routes();

Route::namespace('Site')->group(function () {
    Route::get('/', 'MainController@index');
    Route::get('/links', 'LinksController@index');
    Route::get('/links/{id}', 'LinkStatController@index');
});
