<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WelcomeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CreateInvoiceController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\LiveSearchController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*get Address*/
//Route::post('getUserAddress', [WelcomeController::class, 'getUserAddress']);

/*set Default Address*/
//Route::post('setDefaultAddress', [AddressController::class, 'setDefaultAddress']);

/*create Address*/
Route::post('createAddress', [AddressController::class, 'createAddress']);

/*get delivery details*/
Route::post('getdeliveryDetails', [WelcomeController::class, 'getdeliveryDetails']);

/*get images*/
Route::get('allImages', [WelcomeController::class, 'allImages']);

/*get image details*/
Route::post('imageDetails', [WelcomeController::class, 'imagedetails']);

/*update image details*/
Route::post('updateImageDetails', [WelcomeController::class, 'updateImagedetails']);

/*get tax rate*/
//Route::post('getCategoryTaxRate', [WelcomeController::class, 'getCategoryTaxRate']);

/*sell device image upload*/
Route::post('DeviceuploadPicture', [WelcomeController::class, 'DeviceuploadPicture']);

/*route*/
Route::post('firebaselogin', [AuthController::class, 'firebaselogin']);

Route::post('login', [AuthController::class, 'login']);

/*create invoice*/
Route::post('createInvoice', [CreateInvoiceController::class, 'createInvoice']);

/*razorpay orders*/
Route::post('createOrder', [PaymentController::class, 'createOrder']);

/*live search*/
Route::get('livesearch', [LiveSearchController::class, 'livesearch']);


//orders
Route::group(['middleware' => 'auth:api'], function() {
    /*Orders*/
    Route::get('orders', [OrderController::class, 'index']);

    /*Invoices*/
    Route::get('invoices', [OrderController::class, 'invoices']);
    Route::get('invoice/{id}', [OrderController::class, 'invoiceDetails']);

    /*customers*/
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    Route::post('customer/store', [CustomerController::class, 'store']);
    Route::post('customer/update', [CustomerController::class, 'update']);

    /*category*/
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::post('category/update', [CategoryController::class, 'update']);
    /*category*/

    /*product*/
    Route::get('products', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::post('product/store', [ProductController::class, 'store']);
    Route::post('product/update', [ProductController::class, 'update']);
    /*category*/
});
