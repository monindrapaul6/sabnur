<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SearchController;

/*search*/
Route::get('search', [SearchController::class, 'index']);
