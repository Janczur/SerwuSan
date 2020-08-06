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

Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('billings', 'BillingController');
    Route::post('billings/calculate/settlement', 'BillingController@calculatesettlement')
        ->name('billings.calculate.settlement');

    Route::prefix('providersMargins')->name('providersMargins.')->group(function (){

        Route::get('/', 'ProviderMarginController@index')->name('index');
        Route::get('/import', 'ProviderMarginController@import')->name('import');
        Route::post('/', 'ProviderMarginController@store')->name('store');
        Route::delete('batch/delete', 'ProviderMarginController@batchDelete')->name('batch.delete');

        Route::prefix('editable')->name('editable.')->group(function () {
            Route::put('country/{providerMargin}', 'ProviderMarginController@editableUpdateCountry')->name('update.country');
            Route::put('margin/{providerMargin}', 'ProviderMarginController@editableUpdateMargin')->name('update.margin');
        });

    });

    Route::prefix('providersPricelists')->name('providersPriceLists.')->group(function (){

        Route::get('/', 'ProviderPriceListController@index')->name('index');
        Route::get('/import', 'ProviderPriceListController@import')->name('import');
        Route::post('/store', 'ProviderPriceListController@store')->name('store');
        Route::get('/{providersPricelist}', 'ProviderPriceListController@show')->name('show');
        Route::delete('/{providersPricelist}', 'ProviderPriceListController@destroy')->name('destroy');
        Route::post('/calculateCallPrice', 'ProviderPriceListController@calculateCallPrice')->name('calculateCallPrice');

    });
});





