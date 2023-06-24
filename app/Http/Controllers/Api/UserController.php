<?php

namespace App\Http\Controllers\Api;

use App\{Http\Controllers\Controller,Models\Term,Services\UserService};
use Illuminate\{Auth\AuthenticationException,Http\Request,Support\Facades\Validator};
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('apiMid', ['except' => ['login', 'register', 'forgotPassword', 'term', 'resetPassword','checkUser']]);
    }
    /**
     * @throws AuthenticationException
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        return $this->userService->login($request->only('email', 'password'));
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string',
            'password_confirmation' => 'same:password',
            'term' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        return $this->userService->register($request->all());
    }
    public function forgotPassword(Request $request)
    {
        $result = $this->userService->forgotPassword($request->email);
        return response()->json($result, $result['status'] == 'success' ? 200 : 404);
    }
    public function resetPassword(Request $request)
    {
        return $this->userService->resetPassword($request->all());
    }

    public function refresh(Request $request)
    {
        return $this->userService->refresh();
    }
    #[NoReturn] public function changePassword(Request $request)
    {
        return $this->userService->changePassword($request);
    }
    public function logout()
    {
        $result = $this->userService->logout();
        return response()->json($result, 200);
    }
    public function term()
    {
        return response()->json(['term' => Term::first()]);
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $result = $this->userService->handleSocialiteCallback('google');

        if ($result['status'] == 'success') {
            alert()->success(__('messages.success'));
            return redirect()->route('user.index');
        } else {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function check(Request $request)
    {
//        $token = $request->header('Authorization');
//        $authorizationHeader = $request->header('Authorization');
//        $token = str_replace('Bearer ', '', $authorizationHeader);
        $token = $request->bearerToken();
        return $this->userService->checkUser($token);
    }

    public function handleFacebookCallback()
    {
        $result = $this->userService->handleSocialiteCallback('facebook');
    }
}
