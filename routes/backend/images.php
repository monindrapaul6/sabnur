<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PictureController;

/*Brand*/
Route::get('images', [PictureController::class, 'index']);
Route::get('image/create', [PictureController::class, 'create']);
Route::post('image/store', [PictureController::class, 'store']);
Route::get('image/{id}', [PictureController::class, 'show']);
Route::post('image/update', [PictureController::class, 'update']);
Route::get('image/{id}/delete', [PictureController::class, 'delete']);
