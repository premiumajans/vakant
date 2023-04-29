<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use Authenticatable;

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function login(Request $request)
    {
        if ($this->guard()->attempt($request->only(['email', 'password']))) {
//            return redirect()->route('backend.login');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ]);
    }
}
