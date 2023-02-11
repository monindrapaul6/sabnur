<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;

/*auth controller*/
Route::get('login', [AuthController::class, 'login'])->name('login');

/*fl*/
Route::get('oathlogin', [AuthController::class, 'flogin']);

/*Logout*/
Route::get('logout', [AuthController::class, 'logout']);
