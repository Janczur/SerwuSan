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

Auth::routes([
    'reset' => false, // disabling password reset routes
    'verify' => false, // disabling email verification routes
    'register' => false // disabling register routes
    ]);

Route::get('/', 'HomeController@index')->name('home');

Route::resource('billings', 'BillingController')->middleware('auth');



