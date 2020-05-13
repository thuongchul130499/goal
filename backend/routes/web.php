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

Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('redirect');
Route::get('/auth/google/callback', 'Auth\LoginController@handleProviderCallback')->name('callback');

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
      session(['locale' => $locale]);
    }
    
    return redirect()->back();
})->name('change-lang');


Route::group(['middleware' => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/upload-image', 'UserController@upload');
    Route::get('/notification/{slug}', 'NotificationController@show');
    Route::get('/notifications', 'NotificationController@index')->name('notifications');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@updateProfile')->name('update-profile');
    Route::post('goal/{id}/task', 'GoalController@addTask');    
    Route::resource('goals', 'GoalController');
    Route::resource('tasks', 'TaskController');
    Route::post('/markAsRead', 'UserController@markAsRead');
    Route::post('/users/follow', 'UserController@follow')->name('follow');
    Route::post('/users', 'HomeController@index')->name('users');
    Route::get('users/{id}', 'UserController@show')->name('show-user');
    Route::resource('users', 'UserController')->only(['show', 'update']);
});
