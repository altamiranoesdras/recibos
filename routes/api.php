<?php

use App\Http\Controllers\API\OptionAPIController;
use App\Http\Controllers\API\PermissionAPIController;
use App\Http\Controllers\API\ReciboAPIController;
use App\Http\Controllers\API\RoleAPIController;
use App\Http\Controllers\API\TipoPagoAPIController;
use App\Http\Controllers\API\UserAPIController;

Route::group(['as'=>'api.'], function () {

    Route::resource('options', OptionAPIController::class);



    Route::group(['middleware' => 'auth:api'], function () {

        Route::resource('permissions', PermissionAPIController::class);

        Route::resource('roles', RoleAPIController::class);

        Route::resource('users', UserAPIController::class);
        Route::get('user/add/shortcut/{user}', [UserAPIController::class,'addShortcut'])->name('users.add_shortcut');
        Route::get('user/remove/shortcut/{user}', [UserAPIController::class,'removeShortcut'])->name('users.remove_shortcut');


        Route::resource('tipo_pagos', TipoPagoAPIController::class);


        Route::resource('recibos', ReciboAPIController::class);

    });


});

