<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Relations\Relation;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.dashboard', get_defined_vars());
    }
}
