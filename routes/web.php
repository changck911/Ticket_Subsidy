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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){return view('ticket/v_main');})->middleware(['status']);


Route::get('/login',function(){return view('ticket/v_login');});
Route::post('/login','TicketController@login')->middleware(['login']);

Route::get('/register',function(){return view('ticket/v_register');});
Route::post('/register','TicketController@register')->middleware(['register']);

Route::get('/main',function(){return view('ticket/v_main');})->middleware(['status']);

Route::get('/money' ,'TicketController@money')->middleware(['status']);

Route::get('/logout' ,'TicketController@logout');