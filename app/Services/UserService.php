<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function login(array $credentials): array
    {
        $token = Auth::guard('admin')->attempt($credentials);

        if (!$token) {
            return [
                'status' => 'error',
                'message' => 'Unauthorized',
                'statusCode' => 401,
            ];
        }

        $user = Auth::guard('admin')->user();
        $hasCompany = Admin::find($user->id)->company()->exists();

        return [
            'status' => 'success',
            'user' => $user,
            'company' => $hasCompany,
            'authorisation' => [
                'token' => JWTAuth::fromUser($user),
                'type' => 'bearer',
            ],
            'statusCode' => 200,
        ];
    }

    public function register(array $data): array
    {
        $user = new Admin();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->current_ad_count = 1;
        $user->password = Hash::make($data['password']);
        $user->save();

        $token = JWTAuth::fromUser($user);

        return [
            'status' => 'success',
            'user' => $user,
            'company' => false,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
            'statusCode' => 200,
        ];
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
}
