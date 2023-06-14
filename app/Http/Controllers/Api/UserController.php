<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Term;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('apiMid', ['except' => ['login', 'register', 'forgotPassword', 'term', 'resetPassword']]);
    }

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

        $result = $this->userService->login($request->only('email', 'password'));

        return response()->json($result);
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

        $result = $this->userService->register($request->all());

        return response()->json($result, $result['status'] == 'success' ? 201 : 500);
    }

    public function forgotPassword(Request $request)
    {
        $result = $this->userService->forgotPassword($request->email);

        return response()->json($result, $result['status'] == 'success' ? 200 : 404);
    }

    public function resetPassword(Request $request)
    {
        $result = $this->userService->resetPassword($request->all());

        return response()->json($result, $result['status'] == 'success' ? 200 : 500);
    }

    public function refresh()
    {
        $result = $this->userService->refresh();

        return response()->json($result);
    }

    public function changePassword(Request $request)
    {
        $result = $this->userService->changePassword($request->all());

        return response()->json($result, $result['status'] == 'success' ? 200 : 500);
    }

    public function logout()
    {
        $result = $this->userService->logout();

        return response()->json($result,200);
    }

    public function term()
    {
        $term = Term::first();

        return response()->json(['term' => $term]);
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

    public function handleFacebookCallback()
    {
        $result = $this->userService->handleSocialiteCallback('facebook');

        // Handle the result accordingly
    }
}
