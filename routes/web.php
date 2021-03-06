<?php

use Illuminate\Support\Facades\Route;

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
    return view('master');
});

Route::group(['middleware' => ['auth']],function(){
    Route::group(['prefix' => 'admin'], function(){
        Route::get('/',function(){
            return redirect()->route('home.index');
        });
        Route::resource('home','HomeController');
   
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
