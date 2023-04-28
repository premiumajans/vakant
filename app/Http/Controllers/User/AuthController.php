<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function loginForm()
    {
        return view('user.auth.login');
    }

    public function registerForm()
    {
        return view('user.auth.register');
    }

    public function forgotPasswordForm()
    {
        return view('user.auth.forgot-password');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6',
            'email' => 'unique:email|required|max:255',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
        ]);
        $admin = new Admin();
        $admin->name = $request->username;
        $admin->email = $request->email;
        $admin->current_ad_count = 1;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $firstPackage = Package::first();
        $admin->package()->attach($firstPackage->id);
        return redirect(route('user.loginForm'));
    }

    public function loginUser(Request $request)
    {
        if ($this->guard()->attempt($request->only(['email', 'password']), $request->remember_me)) {
            return redirect()->route('user.index');
        } else {
            return back();
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
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
        $user = Admin::where('email','=',$data->email)->first();
        if(!$user){
            $user = new Admin();
             $user->name = $data->name;
             $user->email = $data->email;
             $user->provider_id = $data->id;
             $user->save();
        }
        Auth::guard('admin')->login($user);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
//        return redirect()->route('frontend.index');
        return 'null';
    }
}
