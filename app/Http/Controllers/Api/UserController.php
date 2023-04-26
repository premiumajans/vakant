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
use Laravel\Socialite\Facades\Socialite;
use PharIo\Version\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['login', 'register', 'forgotPassword', 'term']]);
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
        $hasCompany = Admin::find($user->id)->company()->exists();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'company' => $hasCompany,
            'authorisation' => [
                'token' => JWTAuth::fromUser($user),
                'type' => 'bearer',
            ],
        ]);
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
                    'user' => $user->with('company'),
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
        try {
            if (!Admin::where('email', $request->email)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user-not-found',
                ], 200);
            } else {
                $user = Admin::where('email', $request->email)->first();
                $user->reset_token = md5($request->email);
                $user->save();
                $email = $user->email;
                $data = [
                    'name' => $user->name,
                    'email' => $email,
                    'reset_token' => $user->reset_token,
                ];
                Mail::send('backend.mail.forget-password', $data, function ($message) use ($email) {
                    $message->to($email);
                    $message->subject(__('backend.confirm-your-password'));
                });
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'token' => $user->reset_token,
                        'email' => $user->email,
                    ]
                ], 200);
            }
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'token' => $user->reset_token,
                    'email' => $user->email,
                ]
            ], 200);
        }
    }

    public function resetPassword()
    {

    }

    public function refresh()
    {
//        $token = auth('api')->getToken();
        $user = auth('api')->authenticate();
        $refreshedToken = auth('api')->refresh();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $refreshedToken,
                'type' => 'bearer',
            ]
        ], 200);
    }

    public function changePassword(Request $request)
    {
        try {
            if (!$request->has('new_password') and !$request->has('current_password') and !$request->has('new_confirm_password')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'username' => 'required',
                ]);
                if ($validator->fails()) {
                    return $validator->messages()->toJson();
                } else {
                    $currentUser = Admin::where('email', $request->email)->first();
                    $currentUser->update([
                        'name' => $request->username,
                    ]);
                    return response()->json([
                        'status' => 'profile-was-updated-successfully',
                    ], 200);
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'new_password' => 'required',
                    'username' => 'required',
                    'current_password' => 'required|different:new_password',
                    'new_confirm_password' => 'same:new_password',
                ]);
                if ($validator->fails()) {
                    return $validator->messages()->toJson();
                } else {
                    $currentUser = Admin::where('email', $request->email)->first();
                    $currentUser->update([
                        'name' => $request->username,
                    ]);
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $this->_registerOrLoginUser($user);
            alert()->success(__('messages.success'));
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
    }

    protected function _registerOrLoginUser($data)
    {
        $user = Admin::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new Admin();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->save();
        }
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
}
