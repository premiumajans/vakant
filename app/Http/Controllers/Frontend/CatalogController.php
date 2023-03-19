<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();
        return view('frontend.catalog.index', get_defined_vars());
    }

    public function show($id)
    {
        $catalog = Catalog::find($id);
        return view('frontend.catalog.show', get_defined_vars());
    }
}
