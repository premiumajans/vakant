<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->user()->package()->get()->count() == 0) {
            $packages = Package::all();
            return view('user.packages.index', get_defined_vars());
        } else {
            $package = auth()->guard('admin')->user()->package()->first();
            return view('user.packages.my-package', get_defined_vars());
        }
    }

    public function sendForm($id)
    {
        $admin = auth()->guard('admin')->user();
        $admin->package()->attach($id);
        return redirect()->back();
//        return view('user.packages.buy', get_defined_vars());
    }
}
