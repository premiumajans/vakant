<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    public function index()
    {
        return Mode::all();
    }

    public function show($id)
    {
        return Mode::find($id);
    }
}
