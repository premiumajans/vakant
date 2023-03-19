<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Mixins\LoginRequest;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\fromJSON;

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
            return redirect()->route('frontend.index');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ]);
    }
}
