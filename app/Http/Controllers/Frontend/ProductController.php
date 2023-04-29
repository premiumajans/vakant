<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category->status == 1) {
            return view('frontend.products.index', get_defined_vars());
        } else {
            return redirect()->route('backend.login');
        }
    }
}
