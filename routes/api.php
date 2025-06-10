<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Resources\AuctionResource;
use App\Models\Auction;
use  App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuctionController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\ChekEmailController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductesController;
use App\Http\Controllers\Api\FavotitController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\OrderAppController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ExportOrder;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ShipmentController;
use App\Http\Controllers\Api\CoponController;
use  App\Http\Controllers\Api;





use App\Http\Controllers\Api\ResetPasswordController;





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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    Route::post('/email-verification', [EmailVerificationController::class, 'email_verification']);  
    Route::post('/email-check', [ChekEmailController::class, 'email_check']);    
    Route::post('/reset-password', [ResetPasswordController::class, 'reset_password']); 
   


   

});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/home-page', [HomeController::class, 'index']); 
    Route::post('/home-page2', [HomeController::class, 'index2']); 
    Route::post('/productes_categories', [ProductesController::class, 'get_productes_with_category']);
    Route::post('/search_product', [ProductesController::class, 'search_product']);
    Route::post('/add_favorite', [FavotitController::class, 'add_favorite']);
    Route::post('/remove_favorite', [FavotitController::class, 'remove_favorite']);
    Route::post('/favorite_product', [FavotitController::class, 'favorite_product']);


    Route::post('/add_item_to_cart', [CartController::class, 'add_item_to_cart']);
    Route::post('/remove_item_from_cart', [CartController::class, 'remove_item_from_cart']);
    Route::post('/get_cart_item', [CartController::class, 'get_cart_item']);
    Route::post('/get_cart_count_item', [CartController::class, 'get_cart_count_item']);


    Route::post('/add_adress', [AddressController::class, 'store']);
    Route::post('/remove_address', [AddressController::class, 'destroy']);
    Route::post('/get_address', [AddressController::class, 'show']);
//////

    Route::post('/add_order_app', [OrderAppController::class, 'store']);
   // Route::post('/get_order_app111', [OrderAppController::class, 'destroy']);
    Route::post('/get_order_app', [OrderAppController::class, 'show']);
    Route::post('/get_order_app_detailes', [OrderAppController::class, 'app_order_get_detailes']);
    Route::post('/get_export_order', [ExportOrder::class, 'show']);
   //////

   Route::post('/get_detail_export_order', [ExportOrder::class, 'get_detailes']);

   Route::post('/get_detail_machine_export_order', [ExportOrder::class, 'get_detailes_machine']);

   Route::post('/get_detail_machine_packing', [ExportOrder::class, 'get_detail_machine_packing']);
    Route::post('/get_order_app111', [OrderAppController::class, 'destroy']);
  


    Route::post('/notification', [NotificationController::class, 'sendGCM']);
    Route::post('/notification2', [NotificationController::class, 'sendGCMW']);

    Route::post('/get_notification', [NotificationController::class, 'getNotification']);
    Route::post('/get_user_payment', [NotificationController::class, 'get_user_payment']);
    
    Route::post('/order_payment_detailes', [ExportOrder::class, 'order_payment_detailes']);

    Route::post('/user_balance', [UserController::class,'get_user_balance']);
    Route::post('/user_payment', [UserController::class,'get_user_payment']);

    Route::post('/user_shipmentes', [ShipmentController::class,'get_user_shipmentes']);

    Route::post('/getShipmentDeteil', [ShipmentController::class,'getShipmentDeteil']);
    Route::post('/chek_copon', [CoponController::class,'chek_copon']);
    Route::get('/get_copon', [CoponController::class,'get_copon']);
});
