<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationTranslation;
use App\Models\Experience;
use App\Models\ExperienceTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('experience index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $experiences = Experience::all();
        return view('backend.experiences.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('experience create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.experiences.create');

    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('experience create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $experience = new Experience();
            $experience->save();
            foreach (active_langs() as $lang) {
                $translation = new ExperienceTranslation();
                $translation->locale = $lang->code;
                $translation->experience_id = $experience->id;
                $translation->name = $request->name[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.experience.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.experience.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('experience edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $experience = Experience::find($id);
        return view('backend.experiences.edit', get_defined_vars());
    }

    public function update(Request $request, Experience $experience)
    {
        checkPermission('experience edit');
        try {
            DB::transaction(function () use ($request, $experience) {
                foreach (active_langs() as $lang) {
                    $experience->translate($lang->code)->name = $request->name[$lang->code];
                }
                $experience->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.experience.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.experience.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('experience delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Experience::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.experience.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.experience.index'));
        }
    }
}
