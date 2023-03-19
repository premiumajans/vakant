<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function index(){
        abort_if(Gate::denies('menus index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menus = Menu::all();
        return view('backend.menus.index',get_defined_vars());
    }
}
