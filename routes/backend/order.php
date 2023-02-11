<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;


/*Categories*/
Route::get('orders', [OrderController::class, 'index']);
Route::get('order/{id}', [OrderController::class, 'show']);
Route::post('order/update', [OrderController::class, 'update']);
Route::get('order/{id}/delete', [OrderController::class, 'delete']);
