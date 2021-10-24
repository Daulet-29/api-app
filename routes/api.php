<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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
Route::post('api/order', [OrderController::class, 'createOrder']);
Route::get('api/order/{id}', [OrderController::class, 'getOrderInformation']);
Route::get('api/order', [OrderController::class, 'getAllOrders']);
Route::get('api/get-couriers', [OrderController::class, 'getAllCouriers']);
Route::get('api/courier?free=1', [OrderController::class, 'getFreeCouriers']);
Route::put('api/courier/{id}', [OrderController::class, 'assigningOrderToCourier']);
Route::put('api/order/{id}', [OrderController::class, 'changeStatus']);
Route::get('api/courier/{id}/orders', [OrderController::class, 'completedOrders']);
