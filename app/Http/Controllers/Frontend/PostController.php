<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Paylasim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
//    public function index($id)
//    {
//        $post = Paylasim::where('id','=', $id)
//            ->where('admin_status','=',1)
//            ->where('status','=',1)
//            ->first();
//        $releatedPosts = Paylasim::where('category_id', $post->category_id)->limit(8)->get();
//        $post->increment('view_count');
//        return view('frontend.posts.index', get_defined_vars());
//    }

    public function allPosts()
    {
        $allPosts = Paylasim::where('status', '=', 1)
            ->where('category_id', '=', Category::where('slug', 'news')->value('id'))
            ->where('admin_status', '=', 1)
            ->get();
        return view('frontend.posts.all', get_defined_vars());
    }

    public function selectedPost($id)
    {
        if( $post = Paylasim::where('id','=', $id)
            ->where('admin_status','=',1)
            ->where('status','=',1)
            ->first()){
            $post = Paylasim::find($id);
            $post->increment('view_count');
            $releatedPosts = Paylasim::where('category_id',$post->category_id)->take(4)->where('id','!=',$post->id)->orderBy('created_at','desc')->get();
            return view('frontend.posts.index', get_defined_vars());
        }
        else{
            abort(404);
        }
    }
}
