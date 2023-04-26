<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['']]);
    }

    public function index()
    {
        $user = auth('api')->authenticate();
        return $company = Admin::find($user->id)->company()->get();
    }

}
