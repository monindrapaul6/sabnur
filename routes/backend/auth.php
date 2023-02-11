<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;

Route::group(['prefix' => 'admin'], function() {

    /*auth*/
    Route::get('login', [AuthController::class, 'login']);
    Route::post('postLogin', [AuthController::class, 'postLogin']);

    Route::get('logout', [AuthController::class, 'adminLogout']);
});
