<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;


/*homepage*/
Route::get('/', [WelcomeController::class, 'dashboard']);
