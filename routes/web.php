<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\ProductsController;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use App\Models\Products;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    if (!Auth::guard('ordinary')->check()) {
        return Redirect::to('login');
    } else {
        // $path = storage_path('public/ss.png');

        // if (!File::exists($path)) {
        //     abort(404);
        // }

        // $file = File::get($path);
        // $type = File::mimeType($path);

        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);
        return view('home', ['products' => Products::all()]);
    }
});


Route::post('customers', [CustomersController::class, 'store']);

Route::get('confirmation', function () {
    return view('customers\item-confirmation');
});

Route::get('/all-couriers', function () {
    $allCouriers = ProductCourier::all();
    return view('couriers\courier', ['courier' => $allCouriers]);
});

Route::get('update-status/{id}', function ($id) {

    logger($id);
});

Route::get('login', [LoginController::class, 'login']);
Route::get('register', [LoginController::class, 'register']);

Route::post('sign-up', [LoginController::class, 'signUp']);
Route::post('sign-in', [LoginController::class, 'signIn']);
