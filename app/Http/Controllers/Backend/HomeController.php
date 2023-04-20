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
//        $permissions = [
//            'term index',
//            'term create',
//            'term edit',
//            'term delete',
//        ];
//        foreach ($permissions as $p) {
//            $pp = new Permission();
//            $pp->name = $p;
//            $pp->guard_name = 'web';
//            $pp->save();
//        }
        $counts = [

        ];
        return view('backend.dashboard', get_defined_vars());
    }
}
