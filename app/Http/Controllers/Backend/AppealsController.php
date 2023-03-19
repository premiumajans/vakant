<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\CV;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AppealsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appeals index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appeals = Appeal::all();
        return view('backend.about.appeals.index', get_defined_vars());
    }

    public function delete($id)
    {
        abort_if(Gate::denies('appeals delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            CV::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.about.appeals.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->route('backend.about.appeals.index');
        }
    }
}
