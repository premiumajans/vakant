<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\User\Update\SecurityRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class SecurityController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->user()->provider_id == null) {
            return view('user.security.index');
        }
        else{
            return redirect()->route('user.index');
        }
    }

    public function update(SecurityRequest $request, $id)
    {
        if (auth()->guard('admin')->user()->provider_id == null) {
            try {
                $admin = \App\Models\Admin::find($id);
                if (Hash::check($request->currentPassword, $admin->password)) {
                    $admin->update([
                        'password' => Hash::make($request->newPassword),
                    ]);
                } else {
                    throw new Exception();
                }

                alert()->success(__('messages.success'));
                return redirect(route('user.security'));
            } catch (Exception $e) {
                alert()->error(__('messages.error'));
                return redirect(route('user.index'));
            }
        } else {
            return redirect()->route('user.index');
        }
    }
}
