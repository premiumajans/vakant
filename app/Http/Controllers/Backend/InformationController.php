<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Update\InformationPasswordRequest as PasswordRequest;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index()
    {
        return view('backend.informations.index', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function store(PasswordRequest $request)
    {
        try {
            User::find($request->id)->update([
                'password' => Hash::make($request->password),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error') . $e);
            return redirect()->route('backend.information.index');
        }
    }
}
