<?php
namespace App\Utils\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\{Auth, Hash, Mail, Validator};
use Tymon\JWTAuth\Exceptions\{JWTException, TokenExpiredException};
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'user-not-found',
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

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        try {
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            $user = Auth::user();
            $hasCompany = $user->company()->exists();
            return response()->json([
                'user' => $user,
                'company' => $hasCompany,
                'authorisation' => [
                    'token' => $newToken,
                    'type' => 'bearer',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'unable-to-refresh-token'], 500);
        }
    }

    public function register(array $data): \Illuminate\Http\JsonResponse
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $token = JWTAuth::attempt($data);
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
        if (!User::where('email', $email)->exists()) {
            return [
                'status' => 'error',
                'message' => 'user-not-found',
                'statusCode' => 404,
            ];
        }
        $user = User::where('email', $email)->first();
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

    public function resetPassword(array $data): \Illuminate\Http\JsonResponse
    {
        if (!User::where('email', $data['email'])->exists()) {
            return response()->json([
                'message' => 'email-not-found',
            ], 500);
        }
        $user = User::where('email', $data['email'])->first();
        if ($data['token'] !== $user->reset_token) {
            return response()->json([
                'message' => 'token-is-not-match-email',
            ], 500);
        }
        $validator = Validator::make($data, [
            'new_password' => 'required|string',
            'confirm_password' => 'required|string|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'password-validation-failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $user->password = Hash::make($data['new_password']);
        $user->reset_token = null;
        $user->save();
        return response()->json([
            'message' => 'password-updated-successfully',
        ], 200);
    }

    public function changePassword($request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        if (!$request->has('current_password')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                ], 422);
            }
            $user->name = $request->input('name');
            $user->save();
            return response()->json([
                'message' => 'name-changed-successfully',
            ], 200);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6|different:current_password',
                'confirm_password' => 'required|string|same:new_password',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                ], 422);
            }
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return response()->json([
                    'message' => 'current-password-mismatch',
                ], 401);
            }
            $user->name = $request->name;
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return response()->json([
                'message' => 'password-changed-successfully',
            ], 200);
        }
    }
    /**
     * Check the user based on the provided JWT token.
     *
     * @param string $token
     * @return mixed|null
     */
    public function checkUser($token)
    {
        try {
            JWTAuth::setToken($token);
            if (!$user = Auth::user()) {
                return null;
            }
            return $user;
        } catch (TokenExpiredException|JWTException $e) {
            return null;
        }
    }
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();
        return response()->json([
            'message' => 'logged-out-successfully',
        ], 200);
    }
}
