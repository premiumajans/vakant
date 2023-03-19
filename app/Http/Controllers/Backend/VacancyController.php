<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class VacancyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vacancy edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancies = Vacancy::all();
    }

    public function show($id)
    {
        abort_if(Gate::denies('vacancy index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancy = Vacancy::find($id);
        return view('backend.vacancies.show', get_defined_vars());
    }

    public function approved()
    {
        abort_if(Gate::denies('vacancy index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancies = Vacancy::where('admin_status', 1)->get();
        return view('backend.vacancies.approved', get_defined_vars());
    }

    public function pending()
    {
        abort_if(Gate::denies('vacancy index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancies = Vacancy::where('admin_status', 0)->get();
        return view('backend.vacancies.pending', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.about.vacancy.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $vacancy = new Vacancy();
            $vacancy->age = $request->age;
            $vacancy->salary = $request->salary;
            $vacancy->email = $request->email;
            $vacancy->phone = $request->phone;
            $vacancy->save();
            foreach (active_langs() as $lang) {
                $translation = new VacancyTranslation();
                $translation->title = $request->title[$lang->code];
                $translation->education = $request->education[$lang->code];
                $translation->experience = $request->experience[$lang->code];
                $translation->locale = $lang->code;
                $translation->vacancy_id = $vacancy->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.about.vacancies.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.about.vacancies.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('vacancy edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancy = Vacancy::find($id);
        return view('backend.about.vacancy.edit', get_defined_vars());
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $vacancy) {
                $vacancy->age = $request->age;
                $vacancy->email = $request->email;
                $vacancy->phone = $request->phone;
                $vacancy->salary = $request->salary;
                foreach (active_langs() as $lang) {
                    $vacancy->translate($lang->code)->title = $request->title[$lang->code];
                    $vacancy->translate($lang->code)->experience = $request->experience[$lang->code];
                    $vacancy->translate($lang->code)->education = $request->education[$lang->code];
                }
                $vacancy->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.vacancies.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.vacancies.index'));
        }
    }

    public function delVacancy($id)
    {
        abort_if(Gate::denies('vacancy delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Vacancy::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.about.vacancies.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.about.vacancies.index');
        }
    }
}
