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
        return auth()->guard('web');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        if (auth()->attempt($request->only(['email', 'password']), $request->remember_me)) {
            dd('he');
            return redirect()->route('backend.dashboard');
        } else {
            dd('yox');
            return back();
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ]);
    }
}
