<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrdinaryUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login()
    {
        if (! Auth::guard('ordinary')->check()) {
            return view('filament\auth\login');
        } else {
            return Redirect::to('accept-product');
        }
    }

    public function signIn(Request $request)
    {
        if (Auth::guard('ordinary')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $this->login();

            return Auth::guard('ordinary')->user();
        }
    }

    public function register()
    {
        return view('filament\auth\register');
    }

    public function profile()
    {
        return view('filament\pages\profile', [
            'user' => Auth::guard('ordinary')->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        if (Hash::check($request->curpass, Auth::guard('ordinary')->user()->password)) {
            OrdinaryUser::where('id', Auth::guard('ordinary')->user()->id)->update([
                'password' => Hash::make($request->newpass),
            ]);

            return back();
        }
    }

    public function signUp(Request $request)
    {
        $registered = OrdinaryUser::create([
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname' => $request->name,
        ]);
        $response = new HttpResponse('Set Cookie');

        return $response->withCookie(cookie('current-user', $registered->email));
    }
}
