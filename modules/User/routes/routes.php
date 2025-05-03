<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['namespace'=>'Modules\User\src\Http\Controllers','middleware'=>'web'],function(){
    Route::prefix('admin')->group(function(){
        Route::prefix('users')->group(function(){
            Route::get('/','UserController@index')->name('admin.users.index');
            // Route::get('/detail/{id}','UserController@detail');
            Route::get('/create','UserController@create')->name('admin.users.add');
            Route::post('/create','UserController@store')->name('admin.users.store');
        });
       
    });
    
});
