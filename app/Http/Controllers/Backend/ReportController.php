<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reports = Activity::all();
        return view('backend.report.index', get_defined_vars());
    }

    public function cleanAllReport()
    {
        abort_if(Gate::denies('report delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Activity::truncate();
            alert()->success(__('messages.success'));
            return redirect(route('backend.report'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.report'));
        }
    }

    public function delReport($log)
    {
        abort_if(Gate::denies('report delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $report = Activity::find($log);
            $report->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.report'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.report'));
        }
    }
}
