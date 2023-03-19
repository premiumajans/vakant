<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 1)->get();
        return view('frontend.projects.index', get_defined_vars());
    }

    public function show($id)
    {
        $project = Project::find($id);
        return view('frontend.projects.show', get_defined_vars());
    }
}
