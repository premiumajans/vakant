<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class EducationController extends Controller
{

    public function index()
    {
        checkPermission('education');
        $educations = Education::all();
        return view('backend.education.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('education create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.education.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('education create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $education = new Education();
            $education->save();
            foreach (active_langs() as $lang) {
                $translation = new EducationTranslation();
                $translation->locale = $lang->code;
                $translation->education_id = $education->id;
                $translation->name = $request->name[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.education.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.education.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('education edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $education = Education::find($id);
        return view('backend.education.edit', get_defined_vars());
    }

    public function update(Request $request, Education $education)
    {
        abort_if(Gate::denies('education edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $education) {
                foreach (active_langs() as $lang) {
                    $education->translate($lang->code)->name = $request->name[$lang->code];
                }
                $education->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.education.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.education.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('education delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Education::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.education.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.education.index'));
        }
    }
}
