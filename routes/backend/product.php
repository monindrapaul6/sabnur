<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductBulkController;

/*Products*/
Route::get('products', [ProductController::class, 'index']);
Route::get('product/create', [ProductController::class, 'create']);
Route::post('product/store', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product/update', [ProductController::class, 'update']);
Route::post('productPictures', [ProductController::class, 'productPictures']);
Route::get('productPicture/{picid}/{productid}/delete', [ProductController::class, 'deletePicture']);
Route::get('product/{id}/delete', [ProductController::class, 'delete']);
