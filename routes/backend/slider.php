<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SliderController;

/*Sliders*/
Route::get('sliders', [SliderController::class, 'index']);
Route::get('slider/create', [SliderController::class, 'create']);
Route::post('slider/store', [SliderController::class, 'store']);
Route::get('slider/{id}', [SliderController::class, 'show']);
Route::post('slider/update', [SliderController::class, 'update']);
Route::get('slider/{id}/delete', [SliderController::class, 'delete']);
