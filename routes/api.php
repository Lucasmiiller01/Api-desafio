<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware(['auth:api'])->namespace('Api')->group(function () {

    Route::get('delivery/find/{id}', 'DeliveryController@find')->name('find.delivery');
    Route::get('delivery/all', 'DeliveryController@getAll')->name('all.delivery');
});