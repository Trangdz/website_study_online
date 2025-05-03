<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\src\Http\Controllers;

Route::group(['namespace'=>'Modules\Dashboard\src\Http\Controllers'],function(){
    Route::prefix('admin')->group(function(){   
            Route::get('/','DashboardController@index')->name('admin.dashboard');
            // Route::get('/detail/{id}','UserController@detail');
            // Route::get('/create','UserController@create');
            // Route::get('/store','UserController@stire');
        });
});
