<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;

/*Category*/
Route::get('product/{product_slug}', [ProductController::class, 'index']);
