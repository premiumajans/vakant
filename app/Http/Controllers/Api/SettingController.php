<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class SettingController extends Controller
{

    public function index()
    {
        return response()->json(['settings' => Setting::all()]);
    }

    public function show($id)
    {
        return response()->json(['setting' => Setting::find($id)]);
    }
}
