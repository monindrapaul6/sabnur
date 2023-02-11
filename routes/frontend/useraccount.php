<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\OrderController;


Route::group(['middleware' => 'auth'], function (){

    /*profile*/
    Route::get('account', [AccountController::class, 'account']);
    Route::get('account/profile', [AccountController::class, 'profile']);
    Route::post('accountUpdate', [AccountController::class, 'accountUpdate']);

    /*Invoice*/
    Route::get('account/invoices', [InvoiceController::class, 'index']);
    Route::get('account/invoice/{id}', [InvoiceController::class, 'show']);

    /*Orders*/
    Route::get('account/orders', [OrderController::class, 'index']);
    Route::get('account/order/{id}', [OrderController::class, 'show']);

    //downlaod invoice
    Route::get('account/invoice/{id}/download', [InvoiceController::class, 'downloadInvoice']);
});
