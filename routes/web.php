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

Route::get('/login','TicketController@index');

Route::get('/register','TicketController@register');
Route::post('/register',function(){return 123;});

Route::get('/main','TicketController@main');

Route::get('/money' ,'TicketController@money');

Route::get('/test',function(){ echo encrypt('123');});

Route::get('/db_test','TicketController@db_test');