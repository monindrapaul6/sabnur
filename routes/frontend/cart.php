<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;


/*cart*/
/*Route::group(['middleware' => 'guest'], function () {*/
    Route::get('cart', [CartController::class, 'index']);
    Route::get('cart/add/{id}/{qty}', [CartController::class, 'addToCart']);

    Route::patch('updateCart', [CartController::class, 'updateCart']);
    Route::delete('removeCart', [CartController::class, 'removeCart']);
/*});*/
