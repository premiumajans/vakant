<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('frontend.certificates.index', get_defined_vars());
    }

    public function show($id)
    {
        $certificate = Certificate::find($id);
        return view('frontend.certificates.show', get_defined_vars());
    }
}
