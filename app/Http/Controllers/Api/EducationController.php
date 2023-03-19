<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;


class EducationController extends Controller
{
    public function index()
    {
        return Education::all();
    }

    public function show($id)
    {
        return Education::find($id);
    }
}
