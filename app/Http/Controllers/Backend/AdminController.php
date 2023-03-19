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
        abort_if(Gate::denies('users index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::all();
        return view('backend.users.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.users.create');
    }

    public function delAdmin($id)
    {
        abort_if(Gate::denies('users delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            User::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.users.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->route('backend.users.index');
        }
    }
    public function store(CreateRequest $request)
    {
        abort_if(Gate::denies('users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
}
