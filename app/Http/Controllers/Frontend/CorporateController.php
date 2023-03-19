<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Corporate;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    public function index()
    {
        $corporates = Corporate::all();
        return view('frontend.corporate.index', get_defined_vars());
    }

    public function show($id)
    {
        $corporate = Corporate::find($id);
        return view('frontend.corporate.show', get_defined_vars());
    }
}
