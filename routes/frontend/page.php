<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;

/*Contact*/
Route::get('contact', [PageController::class, 'contact']);
Route::post('contact', [PageController::class, 'contactform']);
