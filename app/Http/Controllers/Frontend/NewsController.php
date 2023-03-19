<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('frontend.news.index', get_defined_vars());
    }

    public function show($id)
    {
        $new = News::find($id);
        return view('frontend.news.show', get_defined_vars());
    }
}
