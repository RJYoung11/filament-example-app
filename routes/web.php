<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomersController;
use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::redirect('/', config('filament.path'));

Route::get('accept-product', function () {
    if (! Auth::guard('ordinary')->check()) {
        return Redirect::to('login');
    } else {
        return view('home', [
            'products' => Products::all(),
            'user' => Auth::guard('ordinary')->user(),
        ]);
    }
});

Route::get('customers', function (Request $request) {
    $customers = Customers::with('delivery')->with('product')->get();

    $newData = collect($customers)->map(function ($data) use ($request) {
        if ($request['filter'] === 'with') {
            if (! is_null($data->delivery)) {
                return $data;
            }
        } else {
            if (is_null($data->delivery)) {
                return $data;
            }
        }
    })->reject(function ($value) {
        return $value === null;
    });

    return view('customers\customers', [
        'customers' => count($request->toArray()) > 0 && $request['filter'] !== 'all' ? $newData : Customers::with('delivery')->with('product')->get(),
        'filter' => count($request->toArray()) < 1 ? 'false' : $request,
    ]);
});

Route::post('customers', [CustomersController::class, 'store']);

Route::post('add-with-courier', [CustomersController::class, 'store_deliver']);

Route::get('confirmation', function () {
    return view('customers\item-confirmation');
});

Route::get('/all-couriers', function () {
    $allCouriers = ProductCourier::all();

    return view('couriers\courier', ['courier' => $allCouriers]);
});

Route::post('update-status', [CustomersController::class, 'updateStatus']);

Route::post('cancel-order', [CustomersController::class, 'cancelOrder']);

Route::get('status', function () {
    return view('couriers\orderstatus', [
        'orders' => Customers::with('delivery')->with('product')->where('ordinary_user_id', Auth::guard('ordinary')->user()->id)->get(),
    ]);
});

Route::get('to-deliver-products', function () {
    $status = DeliveryStatus::with('product')->with('customer')->with('courier')->where([['courier_id', '=', Auth::guard('ordinary')->user()->id], ['status', '!=', 'Package Arrived']])->get();

    return view('couriers\deliverproducts', [
        'delivery' => $status,
    ]);
});

Route::get('logout', function () {
    Auth::guard('ordinary')->logout();

    return redirect('/login');
});
Route::get('login', [LoginController::class, 'login']);
Route::get('register', [LoginController::class, 'register']);
Route::get('profile', [LoginController::class, 'profile']);
Route::post('update-profile', [LoginController::class, 'updateProfile']);

Route::post('sign-up', [LoginController::class, 'signUp']);
Route::post('sign-in', [LoginController::class, 'signIn']);
