<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CategoryController;

/*Category*/
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category_slug}', [CategoryController::class, 'show']);
