<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrdinaryUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login()
    {
        if (!Auth::guard('ordinary')->check()) {
            return view('filament\auth\login');
        } else {
            return Redirect::to('accept-product');
        }
    }

    public function signIn(Request $request)
    {
        if (Auth::guard('ordinary')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $this->login();
        }
    }

    public function register()
    {
        return view('filament\auth\register');
    }

    public function signUp(Request $request)
    {
        $registered = OrdinaryUser::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname' => $request->name
        ]);
        $response = new HttpResponse('Set Cookie');
        return $response->withCookie(cookie('current-user', $registered->email));
    }
}
