<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\WelcomeController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [WelcomeController::class, 'home']);

    /*category*/
    require __DIR__ . '/category.php';

    /*product*/
    require __DIR__ . '/product.php';

    /*invoice*/
    require __DIR__ . '/invoice.php';

    /*Customer*/
    require __DIR__ . '/customer.php';
});
