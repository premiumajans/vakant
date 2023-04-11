<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Package;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        if(!auth('admin')->user()->package()->wherePivot('status','=',1)->exists()){
            $packages = Package::all();
            return view('user.packages.index', get_defined_vars());
        } else {
            $package = auth()->guard('admin')->user()->package()->first();
            $myOldPackages = auth()->guard('admin')->user()->package()->wherePivot('status','=',0)->get();
            return view('user.packages.my-package', get_defined_vars());
        }
    }

    public function sendForm($id)
    {
        try {
        $admin = auth()->guard('admin')->user();
        if(!$admin->package()->wherePivot('status','=',1)->exists()){
            $admin->package()->attach($id, ['current_ads_count' => DB::table('packages')->where('id', $id)->value('ads_count'), 'status' => 1,]);
            alert()->success(__('messages.success'));
            return redirect()->route('user.packageForm');
        }
        else{
            alert()->error(__('messages.you-have-package'));
            return redirect()->route('user.packageForm');
        }
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('user.packageForm');
        }
    }
}
