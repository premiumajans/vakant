<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        if (Menu::where('name', 'team')->value('status') == 1) {
            $teams = Team::where('status', 1)->get();
            return view('frontend.about.team', get_defined_vars());
        } else {
            return redirect()->route('backend.login');
        }
    }
}
