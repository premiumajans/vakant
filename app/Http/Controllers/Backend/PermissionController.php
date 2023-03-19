<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permissions index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        return view('backend.permissions.index', get_defined_vars());
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permissions edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.permissions.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permissions edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Permission::find($id)->update([
                'name' => $request->name
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.permissions.index');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('permissions create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.permissions.create');
    }

    public function givePermission()
    {
        abort_if(Gate::denies('new-permission index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::all();
        return view('backend.permissions.give', get_defined_vars());
    }

    public function giveUserPermission(User $user)
    {
        abort_if(Gate::denies('new-permission create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        return view('backend.permissions.give-user', get_defined_vars());
    }
    public function delPermission($id)
    {
        abort_if(Gate::denies('permissions delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Permission::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.permissions.index');
        }
    }
    public function giveUserPermissionUpdate(Request $request)
    {
        abort_if(Gate::denies('new-permission create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($request->id);
        try {
            DB::transaction(function () use ($request, $user) {
                $user->syncPermissions($request->permissions);
            });
            alert()->success(__('messages.success'));
            return redirect()->route('backend.giveUserPermission', $user->id);
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.giveUserPermission', $user->id);
        }
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permissions create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.permissions.index');
        }
    }
}
