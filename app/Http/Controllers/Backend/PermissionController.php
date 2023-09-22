<?php

namespace App\Http\Controllers\Backend;

use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\CRUDHelper;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

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
        checkPermission('permissions create');
        return view('backend.permissions.create');
    }

    public function givePermission()
    {
        checkPermission('permissions index');
        $users = User::all();
        return view('backend.permissions.give', get_defined_vars());
    }

    public function giveUserPermission(User $user)
    {
        checkPermission('permissions create');
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name', 'asc')->get();
        $permissionGroups = Permission::where('guard_name', 'admin')->get()->groupBy('group_name');
        return view('backend.permissions.give-user', get_defined_vars());
    }

    public function delPermission($id)
    {
        checkPermission('permissions delete');
        return CRUDHelper::remove_item('\Spatie\Permission\Models\Permission', $id);
    }

    public function giveUserPermissionUpdate(Request $request)
    {
        checkPermission('permissions create');
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

    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        checkPermission('permission create');
        addPermission($request->name);
    }
}
