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

Route::prefix('admingallery')->group(function() {
    Route::get('/', 'AdminGalleryController@index')->name('admingallery');
    Route::get('/create', 'AdminGalleryController@create')->name('admingallery.create');
    Route::post('/store', 'AdminGalleryController@store')->name('admingallery.store');
    Route::get('/edit/{id}', 'AdminGalleryController@edit')->name('admingallery.edit');
    Route::post('/update/{id}', 'AdminGalleryController@update')->name('admingallery.update');
    Route::get('/delete/{id}', 'AdminGalleryController@destroy')->name('admingallery.delete');
    Route::get('/gallery-image/{id}', 'AdminGalleryController@imagesIndex')->name('admingallery.images');
    Route::get('/add-gallery-image/{id}', 'AdminGalleryController@addImage')->name('admingallery.imageadd');
    Route::post('/storeimages/{id}', 'AdminGalleryController@storeImages')->name('admingallery.storeimages');
    Route::get('/delete-image/{id}', 'AdminGalleryController@deleteImage')->name('admingallery.delete-image');
});
