<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        if (auth()->guard('admin')->user()->package()->get()->count() == 0) {
            return redirect()->route('user.packageForm');
        }
        return view('user.item.create');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
