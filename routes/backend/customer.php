<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CustomerController;
/*Staffs*/
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customer/create', [CustomerController::class, 'create']);
Route::post('customer/store', [CustomerController::class, 'store']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::post('customer/update', [CustomerController::class, 'update']);
Route::get('customer/{id}/delete', [CustomerController::class, 'delete']);
