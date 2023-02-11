<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;

Route::group(['middleware' => 'auth'], function (){
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('checkoutPost', [CheckoutController::class, 'checkoutPost']);

    /*review checkout*/
    Route::get('confirm/{invoice_id?}', [CheckoutController::class, 'confirmOrder']);

    /*payment controller*/
    Route::post('makePayment', [PaymentController::class, 'makePayment']);

});
