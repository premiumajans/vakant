<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function login(Request $request)
    {
        $user = Admin::find(1);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        dd($success['token']);

        if ($this->guard()->attempt($request->only(['email', 'password']), $request->remember_me)) {
            $user = Admin::find(1);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            dd($success['token']);
        } else {
            return back();
        }
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
//            'expires_in' => auth()->guard('admin')->factory()->getTTL() * 60,
            'user' => auth()->guard('admin')->user()
        ]);
    }
}
