<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ChargeController;

Route::get('charges', [ChargeController::class, 'index']);
Route::get('charge/{id}', [ChargeController::class, 'show']);
Route::post('charge/update', [ChargeController::class, 'update']);
