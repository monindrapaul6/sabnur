<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StateCodeController;

/*State Codes*/
Route::get('statecodes', [StateCodeController::class, 'index']);
Route::get('statecode/create', [StateCodeController::class, 'create']);
Route::post('statecode/store', [StateCodeController::class, 'store']);
Route::get('statecode/{id}', [StateCodeController::class, 'show']);
Route::post('statecode/update', [StateCodeController::class, 'update']);
Route::get('statecode/{id}/delete', [StateCodeController::class, 'delete']);

/*Postal Zips*/
Route::get('postalzips', [StateCodeController::class, 'postalzipindex']);
Route::get('postalzip/create', [StateCodeController::class, 'postalzipcreate']);
Route::post('postalzip/store', [StateCodeController::class, 'postalzipstore']);
Route::post('postalzip/update', [StateCodeController::class, 'postalzipupdate']);
Route::get('postalzip/{id}', [StateCodeController::class, 'postalzipshow']);
Route::get('postalzip/delete/{id}', [StateCodeController::class, 'postalzipdelete']);

Route::post('zipcsv', [StateCodeController::class, 'zipcsvPost']);
