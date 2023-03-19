<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $appeal = new Appeal();
            $appeal->payment_type = $request->account;
            if ($request->hasFile('photo')) {
                $appeal->photo = upload('user/company/appeals', $request->file('photo'));
            }
            auth()->guard('admin')->user()->appeals()->save($appeal);
            alert()->success(__('messages.success'));
            return redirect(route('user.packageForm'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('user.packageForm'));
        }
    }
}
