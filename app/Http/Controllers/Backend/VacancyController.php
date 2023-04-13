<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Http\Requests\Backend\Create\VacancyRequest;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\General\VacancyController as GeneralVacancy;

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
        return view('backend.vacancies.create');
    }

    public function store(VacancyRequest $request)
    {
        abort_if(Gate::denies('vacancy create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $vacancy = new Vacancy();
            $vacancy->causer_type = CauserEnum::ADMIN;
            $vacancy->causer_id = auth()->user()->id;
            $vacancy->admin_status = VacancyAdminEnum::Approved;
            $vacancy->shared_time = Carbon::now();
            $vacancy->approved_time = Carbon::now();
            $vacancy->end_time = Carbon::now()->addDay(settings('vacancy_day'));
            $vacancy->save();
            (new GeneralVacancy())->_addNewVacancy($vacancy, $request);
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
            $vacancy->description->update([
                'position' => $request->position,
                'email' => $request->email,
                'relevant_people' => $request->relevant_people,
                'candidate_requirement' => $request->candidate_requirements,
                'job_description' => $request->about_job,
                'tags' => $request->tags,
                'company' => $request->company,
                'phone' => $request->phone,
                'category_id' => $request->category,
                'max_salary' => $request->maximum_salary,
                'min_salary' => $request->minimum_salary,
                'max_age' => $request->maximum_age,
                'min_age' => $request->minimum_age,
                'city_id' => $request->city,
                'mode_id' => $request->mode,
                'education_id' => $request->education,
                'experience_id' => $request->experience,
            ]);
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
