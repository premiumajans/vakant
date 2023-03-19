<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\b;

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

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('frontend.index');
    }
}
