<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AddressController;

Route::group(['middleware' => 'auth'], function (){
    /*address*/
    Route::get('account/address', [AddressController::class, 'index']);
    Route::get('account/address/create', [AddressController::class, 'create']);
    Route::post('account/address/store', [AddressController::class, 'store']);
    Route::get('account/address/{id}', [AddressController::class, 'show']);
    Route::post('account/address/update', [AddressController::class, 'update']);
    Route::get('account/address/{id}/delete', [AddressController::class, 'delete']);
    Route::get('account/address/{id}/default', [AddressController::class, 'makeDefault']);
});
