<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Vacancy;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Relations\Relation;

class HomeController extends Controller
{
    public function index()
    {
//        Vacancy::where('end_time','<',Carbon::now())->delete();
        return view('backend.dashboard', get_defined_vars());
    }
}
