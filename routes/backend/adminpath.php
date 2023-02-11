<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\WelcomeController;

/*auth*/
require __DIR__ . '/auth.php';

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [WelcomeController::class, 'home']);

    /*category*/
    require __DIR__ . '/category.php';

    /*product*/
    require __DIR__ . '/product.php';

    /*invoice*/
    require __DIR__ . '/invoice.php';

    /*Staff*/
    require __DIR__ . '/staff.php';

    /*Customer*/
    require __DIR__ . '/customer.php';

    /*Charge*/
    require __DIR__ . '/charge.php';

    /*State Codes*/
    require __DIR__ . '/statecodes.php';

    /*Images*/
    require __DIR__ . '/images.php';

    /*sliders*/
    require __DIR__ . '/slider.php';

    /*offers*/
    require __DIR__ . '/offer.php';
});
