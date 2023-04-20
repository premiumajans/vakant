<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['login', 'register', 'forgotPassword', 'term']]);
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|string|email|unique:admins',
                'password' => 'required|string',
                'password_confirmation' => 'same:password',
                'term' => 'required',
            ]);
            if ($validator->fails()) {
                return $validator->messages()->toJson();
            } else {
                $user = new Admin();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->current_ad_count = 1;
                $user->password = Hash::make($request->password);
                $user->save();
                $token = JWTAuth::fromUser($user);
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ], 201);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        $user = Admin::where('email', $request->email)->first();
        $user->reset_token = md5($request->email);
        $user->save();
        $email = $user->email;
        $data = [
            'name' => $user->name,
            'reset_token' => $user->reset_token,
        ];
        Mail::send('backend.mail.forget-password', $data, function ($message) use ($email) {
            $message->to($email);
            $message->subject(__('backend.confirm-your-password'));
        });
    }

    public function resetPassword()
    {

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
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();
        $refreshedToken = $token->refresh();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $refreshedToken,
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

    public function logout()
    {
        try {
            $token = JWTAuth::parseToken();
            $token->invalidate();
            return response()->json([
                'status' => 'success',
                'message' => 'successfully-logged-out',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'not-logged-out',
            ]);
        }
    }

    public function term()
    {
        return response()->json([
            'term' => Term::first(),
        ]);
    }
}
