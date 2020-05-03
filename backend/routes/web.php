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
Auth::routes();

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
      session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('change-lang');


Route::group(['middleware' => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/upload-avatar', 'UserController@upload');
    Route::get('/notification/{slug}', 'NotificationController@show');
    Route::get('/notifications', 'NotificationController@index')->name('notifications');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@updateProfile')->name('update-profile');
});