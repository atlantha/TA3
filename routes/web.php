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

// Route::get('/', function () {
//     return view('master');
// });

Route::group(['middleware' => ['auth']],function(){
    Route::group(['prefix' => 'admin'], function(){
        Route::get('/',function(){
            return redirect()->route('home.index');
        });
        Route::resource('home','HomeController');
    //     Route::resource('about','AboutController');
    //     Route::resource('services','ServiceController');
    //     Route::resource('gallery','GalleryController');
    //     Route::resource('team','TeamController');
    //     Route::resource('contact','ContactController');
    });
});


// Route::get('/','PagesController@home')->name('home-user');
// Route::get('/about','PagesController@about')->name('about-user');
// Route::get('/services','PagesController@services')->name('services-user');
// Route::get('/gallery','PagesController@gallery')->name('gallery-user');
// Route::get('/team','PagesController@gallery')->name('team-user');
// Route::get('contact/create','PagesController@create')->name('contact.create');
// Route::get('contact','PagesController@store')->name('contact.store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
