<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Admin Routes*/
require __DIR__ . '/backend/adminpath.php';

/*Semi Admin Routes*/
require __DIR__ . '/backend/semiadminpath.php';

//dashboard
require __DIR__ . '/frontend/dashboard.php';

/*auth routes*/
require __DIR__ . '/frontend/auth.php';

/*category*/
require __DIR__ . '/frontend/category.php';

/*product*/
require __DIR__ . '/frontend/product.php';

/*cart*/
require __DIR__ . '/frontend/cart.php';

/*checkout*/
require __DIR__ . '/frontend/checkout.php';

/*address*/
require __DIR__ . '/frontend/address.php';

/*user Account*/
require __DIR__ . '/frontend/useraccount.php';

/*feedback*/
require __DIR__ . '/frontend/feedback.php';

/*search*/
require __DIR__ . '/frontend/search.php';

/*page*/
require __DIR__ . '/frontend/page.php';

Route::get('/{path?}', [WelcomeController::class, 'getpages'])->where('path', '.*');
