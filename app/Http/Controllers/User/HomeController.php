<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $counts = [
            'vacancies' => 0,
            'packages' => auth()->guard('admin')->user()->package()->count(),
        ];
        return view('user.index', get_defined_vars());
    }
}
