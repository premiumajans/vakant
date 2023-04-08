<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            $admin = auth()->guard('admin')->user();
            if (!$admin->package()->exists()) {
                $admin->package()->attach($id, ['current_ads_count' => DB::table('packages')->where('id', $id)->value('ads_count')]);
            }
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
}
