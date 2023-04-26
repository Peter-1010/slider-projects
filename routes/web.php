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

//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function (){
    Route::group(['namespace'=>'admin', 'prefix'=>'admin'], function (){
        Route::get('index', 'AdminController@getAll')->name('admin.index');
        Route::get('create', 'AdminController@create');
        Route::post('insert', 'AdminController@insert')->name('admin.insert');
        Route::get('edit/{product_id}', 'AdminController@edit')->name('admin.edit');
        Route::post('update/{product_id}', 'AdminController@update')->name('admin.update');
        Route::get('delete/{product_id}', 'AdminController@delete')->name('admin.delete');
        Route::get('delete/{product_id}', 'AdminController@delete')->name('admin.delete');
        Route::get('lang', 'AdminController@getLangs');
    });
//});
