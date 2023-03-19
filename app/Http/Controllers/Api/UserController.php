<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 422);
        }
        if (Auth::guard('admin')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
//            $siteUser = Auth::guard('api')->user();
//            $token = $siteUser->createToken('VakantUserToken', ['api'])->plainTextToken;
//            return response()->json(['token' => $token]);
            echo 'okey';
        }
    }
}
