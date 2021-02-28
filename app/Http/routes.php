<?php

Route::get('/', function () {
    //$excel = App::make('excel');
    return redirect('/home');
});
Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('importExport', 'ExcelController@importExport')->name('uploadexcel');

Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');

Route::get('crudapp', 'HomeController@crudapp')->name('crudapp');

Route::get('/tra-cuu', 'HomeController@tracuu')->name('tracuu');
Route::get('/ket-qua-tra-cuu', 'HomeController@kqtracuu')->name('kqtracuu');
Route::get('/bang-cong', 'HomeController@bangcong')->name('bangcong');
Route::get('/bang-cong/data', 'HomeController@bangcongData')->name('bangcong.data');

Route::post('importExcel', 'ExcelController@importExcel');

// CRUD ROUTE
Route::group(['prefix' => 'crud'], function(){
    Route::get('/data/{table}', 'CrudController@datatable')->name('crud.data');
    Route::get('/{table}', 'CrudController@index')->name('crud.index');
    Route::get('/{table}/show/{id}', 'CrudController@show')->name('crud.show');
    Route::get('/{table}/create', 'CrudController@create')->name('crud.create');
    Route::post('/{table}/store', 'CrudController@store')->name('crud.store');
    Route::get('/{table}/edit/{id}', 'CrudController@edit')->name('crud.edit');
    Route::patch('/{table}/{id}', 'CrudController@update')->name('crud.update');
    Route::delete('/{table}/destroy/{id}', 'CrudController@destroy')->name('crud.destroy');
});

Route::get('/utility/get-array-info', 'HomeController@getArrayInfos');