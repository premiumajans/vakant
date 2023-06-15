<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): \Illuminate\Http\JsonResponse
    {
        if (!Auth::guard('admin')->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::guard('admin')->user();
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
        $hasCompany = $user->company()->exists();
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'user' => $user,
            'company' => $hasCompany,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ], 200);
    }

    /**
     * @throws AuthenticationException
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], 401);
        }
        $user = JWTAuth::user();
        return response()->json([
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }
    public function logout(): array
    {
        Auth::guard('admin')->logout();
        return [
            'message' => 'logged-out-successfully',
        ];
    }

    public function register(array $data): \Illuminate\Http\JsonResponse
    {
        $user = new Admin();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->current_ad_count = 1;
        $user->password = Hash::make($data['password']);
        $user->save();
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'user' => $user,
            'company' => false,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ], 200);
    }

    public function forgotPassword(string $email): array
    {
        if (!Admin::where('email', $email)->exists()) {
            return [
                'status' => 'error',
                'message' => 'user-not-found',
                'statusCode' => 404,
            ];
        }
        $user = Admin::where('email', $email)->first();
        $user->reset_token = md5($email);
        $user->save();

        $data = [
            'name' => $user->name,
            'email' => $email,
            'reset_token' => $user->reset_token,
        ];
        Mail::send('backend.mail.forget-password', $data, function ($message) use ($email) {
            $message->to($email);
            $message->subject(__('backend.confirm-your-password'));
        });
        return [
            'status' => 'success',
            'data' => [
                'token' => $user->reset_token,
                'email' => $user->email,
            ],
            'statusCode' => 200,
        ];
    }

    public function resetPassword(array $data): array
    {
        if (!Admin::where('email', $data['email'])->exists()) {
            return [
                'status' => 'error',
                'message' => 'email-not-found',
                'statusCode' => 500,
            ];
        }

        $user = Admin::where('email', $data['email'])->first();

        if ($data['token'] !== $user->reset_token) {
            return [
                'status' => 'error',
                'message' => 'token-is-not-match-email',
                'statusCode' => 500,
            ];
        }
        $validator = Validator::make($data, [
            'new_password' => 'required|string',
            'confirm_password' => 'required|string|same:new_password',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => 'password-validation-failed',
                'errors' => $validator->errors(),
                'statusCode' => 422,
            ];
        }
        $user->password = Hash::make($data['new_password']);
        $user->reset_token = null;
        $user->save();
        return [
            'status' => 'success',
            'message' => 'password-updated-successfully',
            'statusCode' => 200,
        ];
    }

    #[NoReturn] public function changePassword(array $data): \Illuminate\Http\JsonResponse
    {
        $user = auth('api')->authenticate();
        if (empty($data['password'])) {
            $validator = Validator::make($data, [
                'name' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                ], 422);
            }
            $user->name = $data['name'];
            $user->save();
            return response()->json([
                'message' => 'name-changed-successfully',
            ], 200);
        } else {
            $validator = Validator::make($data, [
                'current_password' => 'required|string',
                'new_password' => 'required|string',
                'confirm_password' => 'required|string|same:new_password',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                ], 422);
            }
            if (!Hash::check($data['current_password'], $user->password)) {
                return response()->json([
                    'message' => 'current-password-mismatch',
                ], 401);
            }
            $user->password = Hash::make($data['new_password']);
            $user->save();
            return response()->json([
                'message' => 'password-changed-successfully',
            ], 200);
        }
    }
}
