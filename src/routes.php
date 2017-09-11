<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2017
 * Time: 15:25
 */


Route::group(['prefix'=>'admin','namespace' => 'Trafik8787\LaraCrud\Controllers'], function() {

    //Route::get('qwe', ['as' => 'qwe','uses' => 'AdminController@showProfile']);

    Route::get('{adminModel}', [
        'as'   => 'model.showTable',
        'uses' => 'AdminController@showTable',
    ]);

    Route::get('{adminModel}/{adminModelId}/edit', [
        'as'   => 'model.edit',
        'uses' => 'AdminController@showEdit',
    ]);

    Route::get('{adminModel}/create', [
        'as'   => 'model.create',
        'uses' => 'AdminController@showCreate',
    ]);

    Route::post('{adminModel}/create', [
        'as'   => 'model.store',
        'uses' => 'AdminController@postStore',
    ]);

});

//Route::namespace('Trafik8787\LaraCrud\Controllers\Admin')->group(function () {
//    Route::get('qwe', ['as' => 'qwe','uses' => 'AdminController@showProfile']);
//});

//Route::prefix('admin')->group(function () {
//    Route::get('qwe', 'Trafik8787\LaraCrud\Controllers\Admin\AdminController@showProfile');
//});