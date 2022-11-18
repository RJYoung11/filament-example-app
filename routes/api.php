<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
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


Route::get('customers/status/{id}/{rate}', [CustomersController::class, 'checkStatus']);
Route::post('customers', [CustomersController::class, 'store']);
Route::put('customers/status/{id}', [CustomersController::class, 'update']);


Route::get('products', [ProductsController::class, 'index']);
