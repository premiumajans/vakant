<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class Statistics extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('statistics index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statistics = \App\Models\Statistics::all();
        return view('backend.statistics.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('statistics create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.statistics.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('statistics create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $statistics = new \App\Models\Statistics();
            $statistics->name = $request->name;
            $statistics->count = $request->count;
            $statistics->save();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.statistics.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.statistics.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('statistics edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statistic = \App\Models\Statistics::find($id);
        return view('backend.statistics.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('statistics edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $statistic = \App\Models\Statistics::find($id);
            $statistic->update([
                'name' => $request->name,
                'count' => $request->count
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.statistics.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.statistics.index');
        }
    }

    public function delStat($id)
    {
        abort_if(Gate::denies('statistics delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $statistic = \App\Models\Statistics::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.statistics.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.statistics.index');
        }
    }

}
