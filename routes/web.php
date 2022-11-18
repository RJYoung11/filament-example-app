<?php

use App\Http\Controllers\CustomersController;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/accept-product', function () {
    return view('home', ['name' => 'Bulantoy']);
});


Route::post('customers', [CustomersController::class, 'store']);

Route::get('/confirmation', function () {
    return view('customers\item-confirmation');
});

Route::get('/all-couriers', function () {
    $allCouriers = ProductCourier::all();
    return view('couriers\courier', ['courier' => $allCouriers]);
});

Route::get('update-status/{id}/{name}', function ($id, $name) {
    $deliverStatus = DeliveryStatus::where('courier_name', $name)->first();
    $deliverStatus->status = "On The Way";

    $deliverCouriers = ProductCourier::where('courier_name', $id)->first();
    $deliverCouriers->to_deliver_products = null;

    $deliverCouriers->save();
    $deliverStatus->save();

    return $deliverStatus;
});
