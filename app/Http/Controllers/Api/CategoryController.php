<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('alt')->get();
    }

    public function show($id)
    {
        return Category::where('id',$id)->with('alt')->get();
    }
}
