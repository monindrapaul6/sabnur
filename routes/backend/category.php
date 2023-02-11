<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

/*Categories*/
Route::get('categories', [CategoryController::class, 'index']);
Route::get('category/create', [CategoryController::class, 'create']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::post('category/update', [CategoryController::class, 'update']);
Route::get('category/{id}/delete', [CategoryController::class, 'delete']);

Route::post('categorySEOupdate', [CategoryController::class, 'categorySEOupdate']);
