<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuctionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [UserController::class, 'store']);
Route::get('auction/all', [AdminController::class, 'AllAuction']);
Route::get('count/all', [AdminController::class, 'Allcount']);



Route::get('auction/create/getproduct/{id}', [ProductController::class, 'getproductsbyid']);

Route::group(['middleware' => 'auth:api'], function ()
{
    //public routes
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);

    //admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function ()
    {
        Route::resource('/categories', CategoryController::class)->only(['store', 'update']);
        Route::resource('/products', ProductController::class);
        Route::resource('/auction', AuctionController::class);
        Route::get('auction-data/past', [AuctionController::class, 'PastAuction']);
        Route::get('auction-data/running', [AuctionController::class, 'RunningAuction']);
        Route::get('auction-data/upcoming', [AuctionController::class, 'UpcomingAuction']);
        Route::get('auction-data/past/{id}', [AuctionController::class, 'updateAuctionStatus']);
        Route::get('auction-data/details/{id}', [AuctionController::class, 'getauctiondetails']);
        Route::get('/bidders', [UserController::class, 'getBidders']);
        Route::get('/bidders/{id}', [UserController::class, 'getBidder']);
        Route::put('/bidders/{id}', [UserController::class, 'updateBidder']);
        Route::get('/approvebidder/{id}/status/{is_approved}', [UserController::class, 'approveBidder']);
    });

    //bidder routes
    Route::group(['prefix' => 'bidder', 'middleware' => 'is_bidder'], function ()
    {
        //
    });
});
