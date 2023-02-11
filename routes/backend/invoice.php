<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\InvoiceController;

/*Categories*/
Route::get('invoices', [InvoiceController::class, 'index']);
Route::get('invoice/{id}', [InvoiceController::class, 'show']);
Route::post('invoice/update', [InvoiceController::class, 'update']);
Route::get('invoice/{id}/delete', [InvoiceController::class, 'delete']);
