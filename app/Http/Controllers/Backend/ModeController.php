<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\mode;
use App\Models\modeTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ModeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mode index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $modes = mode::all();
        return view('backend.mode.index', get_defined_vars());

    }

    public function create()
    {
        abort_if(Gate::denies('mode create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.mode.create');
    }

    public function store(Request $request)
    {
        try {
            abort_if(Gate::denies('mode create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $mode = new Mode();
            $mode->save();
            foreach (active_langs() as $lang) {
                $translation = new modeTranslation();
                $translation->locale = $lang->code;
                $translation->mode_id = $mode->id;
                $translation->name = $request->name[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.modes.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.modes.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('mode edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mode = Mode::find($id);
        return view('backend.mode.edit', get_defined_vars());
    }

    public function update(Request $request, Mode $mode)
    {
        abort_if(Gate::denies('mode edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $mode) {
                foreach (active_langs() as $lang) {
                    $mode->translate($lang->code)->name = $request->name[$lang->code];
                }
                $mode->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.modes.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.modes.index'));
        }
    }

    public function delete($id)
    {
        try {
            Mode::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.modes.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.modes.index'));
        }
    }
}
