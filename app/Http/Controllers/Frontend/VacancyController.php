<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Http\Requests\Frontend\CheckUserRequest;
use App\Http\Requests\Frontend\Create\VacancyRequest;
use App\Models\Admin;
use App\Models\Company;
use App\Models\CV;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        return view('frontend.vacancies.index');
    }

    public function store(VacancyRequest $request)
    {
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
            $vacancy->company_type = CompanyEnum::SINGLE;
            $vacancy->company = $request->company;
            $vacancy->relevant_people = $request->relevant_people;
            $vacancy->candidate_requirement = $request->candidate_requirements;
            $vacancy->job_description = $request->about_job;
            $vacancy->tags = $request->tags;
            $vacancy->admin_status = VacancyAdminEnum::Pending;
            $vacancy->admin_id = 0;
            vacancy_time($vacancy);
            $vacancy->save();
            return view('frontend.vacancies.pending', ['id' => $vacancy->id,'position' => $vacancy->position]);
        } catch (Exception $exception) {
            alert()->error(__('messages.error'));
            return redirect(route('frontend.new-vacancy'));
        }
    }

    public function checkUser(CheckUserRequest $request)
    {
        try {
            if (!in_array($request->email, Vacancy::all()->pluck('email')->toArray())
                and
                !in_array($request->email, Company::all()->pluck('email')->toArray())
                and
                !in_array($request->phone, Vacancy::all()->pluck('phone')->toArray())
                and
                !in_array($request->phone, Company::all()->pluck('phone')->toArray())
                and
                !in_array($request->email, Admin::all()->pluck('email')->toArray())
            ) {
            }
        } catch (Exception $exception) {
        }
    }
}
