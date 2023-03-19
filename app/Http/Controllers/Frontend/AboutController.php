<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Director;
use App\Models\Forigner;

class AboutController extends Controller
{
    public function index(){
        $about = About::find(1);
        $directors = Director::where('status', 1)->get();
        $forigners = Forigner::all();
        return view('frontend.about.index',get_defined_vars());
    }
}
