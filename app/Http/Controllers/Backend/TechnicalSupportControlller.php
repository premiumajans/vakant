<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TechnicalSupportControlller extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('technical-support index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $supports = Support::all();
        return view('backend.support.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('technical-support create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.support.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('technical-support create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $support = new Support();
            $support->save();
            foreach (active_langs() as $active_lang) {
                $translation = new SupportTranslation();
                $translation->description = $request->description[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->support_id = $support->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.support.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.support.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('technical-support edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $support = Support::find($id);
        return view('backend.support.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('technical-support edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $support = Support::find($id);
            DB::transaction(function () use ($request, $support) {
                foreach (active_langs() as $lang) {
                    $support->translate($lang->code)->description = $request->description[$lang->code];
                }
                $support->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.support.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.support.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('technical-support delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Support::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.support.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.support.index'));
        }
    }
}
