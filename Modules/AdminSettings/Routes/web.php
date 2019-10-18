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

Route::group(['prefix'=>'admin/settings','middleware' => 'auth'],function() {
    Route::get('/', 'AdminSettingsController@index')->name('admin.settings');
    Route::post('/store','AdminSettingsController@store')->name('admin.settings.store');
    Route::post('/social/store','AdminSettingsController@socialStore')->name('admin.settings.social.store');
});
