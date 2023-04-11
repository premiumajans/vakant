<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Http\Requests\Backend\Create\VacancyRequest;
use App\Models\Vacancy;
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
        $vacancies = DB::table('vacancies')->where('admin_status', 1)->get();
        return view('backend.vacancies.approved', get_defined_vars());
    }

    public function pending()
    {
        abort_if(Gate::denies('vacancy index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancies = Vacancy::where('admin_status',0)->get();
        return view('backend.vacancies.pending', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.vacancies.create');
    }

    public function store(VacancyRequest $request)
    {
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $vacancy = new Vacancy();
            $vacancy->email = $request->email;
            $vacancy->phone = $request->phone;
            $vacancy->position = $request->position;
            $vacancy->category_id = $request->category;
            $vacancy->max_salary = $request->maximum_salary;
            $vacancy->min_salary = $request->minimum_salary;
            $vacancy->max_age = $request->maximum_age;
            $vacancy->min_age = $request->minimum_age;
            $vacancy->city_id = $request->city;
            $vacancy->education_id = $request->education;
            $vacancy->experience_id = $request->experience;
            $vacancy->company_type = CauserEnum::ADMIN;
            $vacancy->company = $request->company;
            $vacancy->relevant_people = $request->relevant_people;
            $vacancy->candidate_requirement = $request->candidate_requirements;
            $vacancy->job_description = $request->about_job;
            $vacancy->tags = $request->tags;
            $vacancy->admin_status = VacancyAdminEnum::Approved;
            $vacancy->admin_id = auth()->user()->id;
            vacancy_time($vacancy);
            $vacancy->save();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.approvedVacancies');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.approvedVacancies');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('vacancy edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacancy = Vacancy::find($id);
        return view('backend.vacancies.edit', get_defined_vars());
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $vacancy->email = $request->email;
            $vacancy->phone = $request->phone;
            $vacancy->position = $request->position;
            $vacancy->category_id = $request->category;
            $vacancy->max_salary = $request->maximum_salary;
            $vacancy->min_salary = $request->minimum_salary;
            $vacancy->max_age = $request->maximum_age;
            $vacancy->min_age = $request->minimum_age;
            $vacancy->city_id = $request->city;
            $vacancy->education_id = $request->education;
            $vacancy->experience_id = $request->experience;
            $vacancy->company_type = CauserEnum::ADMIN;
            $vacancy->company = $request->company;
            $vacancy->relevant_people = $request->relevant_people;
            $vacancy->candidate_requirement = $request->candidate_requirements;
            $vacancy->job_description = $request->about_job;
            $vacancy->tags = $request->tags;
            $vacancy->admin_id = auth()->user()->id;
            $vacancy->save();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function approveVacancy($id)
    {
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $vacancy = Vacancy::find($id);
            $vacancy->admin_status = 1;
            $vacancy->admin_id = auth()->user()->id;
            $vacancy->save();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.pendingVacancies');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.pendingVacancies');
        }
    }

    public function delVacancy($id)
    {
        abort_if(Gate::denies('vacancy delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Vacancy::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.pendingVacancies');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.pendingVacancies');
        }
    }
}
