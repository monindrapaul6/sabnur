<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OfferController;

/*Sliders*/
Route::get('offers', [OfferController::class, 'index']);
Route::get('offer/create', [OfferController::class, 'create']);
Route::post('offer/store', [OfferController::class, 'store']);
Route::get('offer/{id}', [OfferController::class, 'show']);
Route::post('offer/update', [OfferController::class, 'update']);
Route::get('offer/{id}/delete', [OfferController::class, 'delete']);
