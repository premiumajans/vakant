<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Create\AdminRequest as CreateRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index()
    {
        checkPermission('users index');
        $users = User::all();
        return view('backend.users.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('users create');
        return view('backend.users.create');
    }

    public function store(CreateRequest $request)
    {
        checkPermission('users create');
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.users.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.users.index');
        }
    }

    public function delAdmin($id)
    {
        checkPermission('users delete');
        try {
            User::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.users.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->route('backend.users.index');
        }
    }
}
