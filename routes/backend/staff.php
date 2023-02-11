<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StaffController;

/*Staffs*/
Route::get('staffs', [StaffController::class, 'index']);
Route::get('staff/create', [StaffController::class, 'create']);
Route::post('staff/store', [StaffController::class, 'store']);
Route::get('staff/{id}', [StaffController::class, 'show']);
Route::post('staff/update', [StaffController::class, 'update']);
Route::get('staff/{id}/delete', [StaffController::class, 'delete']);
