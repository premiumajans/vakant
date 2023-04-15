<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('admin')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::guard('admin')->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => JWTAuth::fromUser($user),
                'type' => 'bearer',
            ],
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('admin')->user(),
            'auth' => [
                'token' => Auth::guard('admin')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'new_password' => 'required',
                'current_password' => 'required|different:new_password',
                'new_confirm_password' => 'same:new_password',
            ]);
            if ($validator->fails()) {
                return $validator->messages()->toJson();
            } else {
                $currentUser = Admin::where('email', $request->email)->first();
                if (Hash::check($request->current_password, $currentUser->password)) {
                    $currentUser->update([
                        'password' => Hash::make($request->new_password),
                    ]);
                    return response()->json([
                        'status' => 'password-was-changed-successfully',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'current_password_is_not_correct',
                    ], 500);
                }
            }
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'try_error',
            ], 500);
        }
    }
}
