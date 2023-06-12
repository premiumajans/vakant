<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    public function index()
    {
        checkPermission('about index');
        $about = About::first();
        return view('backend.company-and-products.index', get_defined_vars());
    }

    public function update(Request $request, About $about)
    {
        checkPermission('about edit');
        try {
            DB::transaction(function () use ($request, $about) {
                foreach (active_langs() as $lang) {
                    $about->translate($lang->code)->content = $request->content1[$lang->code];
                }
                $about->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.company-and-products.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.company-and-products.index'));
        }
    }
}
