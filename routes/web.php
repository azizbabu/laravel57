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

Auth::routes(['verify' => true]);

Route::middleware(['verified', 'auth'])->group(function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::any('/profile', 'ProfileController@index')->name('profile');
});

Route::prefix('api')->group(function() {
    Route::resource('notes', 'NotesController');

    Route::put('/notes/{note}/toggleFavourite', 'NotesController@toggleFavourite');
});

Route::get('charge', 'ChargeController@index');
Route::post('charge', 'ChargeController@store');

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

