<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        return view('backend.dashboard', get_defined_vars());
    }
}
