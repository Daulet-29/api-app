<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/create-order', [OrderController::class, 'createOrder']);
Route::post('/get-order-information', [OrderController::class, 'getOrderInformation']);
Route::get('/get-all-orders', [OrderController::class, 'getAllOrders']);
Route::get('/get-all-couriers', [OrderController::class, 'getAllCouriers']);
Route::get('/get-free-couriers', [OrderController::class, 'getFreeCouriers']);
Route::put('/assigning-order-to-courier', [OrderController::class, 'assigningOrderToCourier']);
Route::put('/change-status', [OrderController::class, 'changeStatus']);
Route::post('/completed-orders-by-courier', [OrderController::class, 'completedOrdersByCourier']);
