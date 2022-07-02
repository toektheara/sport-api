<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BakeryShopController;
use App\Http\Controllers\CakeCategoryController;

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
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

// Public
Route::get('/me', [AuthController::class, 'me']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Dashbaord
Route::get('/dashboard/total', [DashboardController::class, 'dashboardTotal']);

// Audience
Route::get('/audience', [AudienceController::class, 'me']);
Route::post('/audienceLogin', [AudienceController::class, 'login']);
Route::post('/audienceRegister', [AudienceController::class, 'register']);

// Cake
Route::get('/cakes', [CakeController::class, 'cakeList']);
Route::get('/cake/{id}', [CakeController::class, 'cakeDetail']);

// Cake Category
Route::get('/cake-categories', [CakeCategoryController::class, 'cakeCategoryList']);
Route::get('/cake-category/{id}', [CakeCategoryController::class, 'cakeCategoryDetail']);

// Bakery Shop
Route::get('/bakery-shops', [BakeryShopController::class, 'bakeryShopList']);
Route::get('/bakery-shop/{id}', [BakeryShopController::class, 'bakeryShopDetail']);

// Protected
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Cake
    Route::post('/cake/create', [CakeController::class, 'createCake']);
    Route::post('/cake/{id}/update', [CakeController::class, 'updateCake']);

    // Cake Category
    Route::post('/cake-category/create', [CakeCategoryController::class, 'createCakeCategory']);
    Route::post('/cake-category/{id}/update', [CakeCategoryController::class, 'updateCakeCategory']);

    // Bakery Shop
    Route::post('/bakery-shop/create', [BakeryShopController::class, 'createBakeryShop']);
    Route::post('/bakery-shop/{id}/update', [BakeryShopController::class, 'updateBakeryShop']);

    Route::get('/users', function (Request $request) {
        return $request->user();
    });
});