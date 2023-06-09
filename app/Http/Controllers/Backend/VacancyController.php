<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Http\Enums\VacancyEnum;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Create\VacancyRequest;
use App\Models\Vacancy;
use App\Models\VacancyUpdate;
use App\Services\PremiumVacancyService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\General\VacancyController as GeneralVacancy;

class VacancyController extends Controller
{
    public function __construct(PremiumVacancyService $premiumVacancyService)
    {
        $this->premiumVacancyService = $premiumVacancyService;
    }

    public function index()
    {
        checkPermission('vacancy index');
        $vacancies = Vacancy::all();
    }

    public function create()
    {
        checkPermission('vacancy create');
        return view('backend.vacancies.create');
    }

    public function store(VacancyRequest $request)
    {
        checkPermission('vacancy create');
        try {
            $vacancy = new Vacancy();
            $vacancy->causer_type = CauserEnum::ADMIN;
            $vacancy->causer_id = auth()->user()->id;
            $vacancy->admin_status = VacancyAdminEnum::Approved;
            $vacancy->vacancy_type = VacancyEnum::SIMPLE;
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
        checkPermission('vacancy edit');
        $vacancy = Vacancy::find($id);
        return view('backend.vacancies.edit', get_defined_vars());
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        checkPermission('vacancy edit');
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
    public function show($id)
    {
        checkPermission('vacancy index');
        $vacancy = Vacancy::find($id);
        return view('backend.vacancies.show', get_defined_vars());
    }

    public function getPremium($id)
    {
        checkPermission('vacancy edit');
        $this->premiumVacancyService->makeVacancyPremium($id, 1);
        return redirect()->back();
    }

    public function getPremiumTime(Request $request, $id)
    {
        checkPermission('users create');
        $this->premiumVacancyService->extendPremiumTime($id, $request->time);
        return redirect()->back();
    }

    public function getPremiumCancel($id)
    {
        checkPermission('users create');
        $vacancy = Vacancy::find($id);
        if ($vacancy) {
            $this->premiumVacancyService->deletePremium($vacancy);
        }
        alert()->success(__('messages.success'));
        return redirect()->back();
    }

    public function approved()
    {
        checkPermission('vacancy index');
        $vacancies = Vacancy::where('admin_status', 1)->get();
        return view('backend.vacancies.approved', get_defined_vars());
    }

    public function pending()
    {
        checkPermission('vacancy index');
        $vacancies = Vacancy::where('admin_status', 0)->get();
        return view('backend.vacancies.pending', get_defined_vars());
    }

    public function updated()
    {
        checkPermission('vacancy index');
        $updatedVacancies = VacancyUpdate::all();
        return view('backend.vacancies.updated', get_defined_vars());
    }

    public function approveVacancy($id)
    {
        checkPermission('vacancy create');
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

    public function delete($id)
    {
        checkPermission('vacancy index');
        return CRUDHelper::remove_item('\App\Models\Vacancy',$id);
    }
}
