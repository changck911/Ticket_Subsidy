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

Route::get('/',function(){return redirect('/money');})->middleware(['status']);


Route::get('/login',function(){return view('ticket/v_login');});
Route::post('/login','TicketController@login')->middleware(['login']);

Route::get('/register',function(){return view('ticket/v_register');});
Route::post('/register','TicketController@register')->middleware(['register']);

Route::get('/giant','TicketController@giant')->middleware(['status']);

Route::get('/logout' ,'TicketController@logout');

Route::post('/change_passwd','TicketController@change_passwd')->middleware(['status']);

Route::get('/main','TicketController@index')->middleware(['status']);

Route::get('/money' ,'TicketController@money')->middleware(['status']);
Route::post('/search','TicketController@search')->middleware(['status','ticket']);

Route::post('/new_data','TicketController@new_ticket')->middleware(['status','ticket']);



// Route::get('/init_village','TicketController@init_village');