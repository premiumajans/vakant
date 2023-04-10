<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        if (auth()->guard('admin')->user()->package()->get()->count() == 0) {
            return redirect()->route('user.packageForm');
        }
        return view('user.item.create');
    }

    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->package()->exists()) {
            alert()->error(__('messages.dont-have-package'));
            return redirect()->route('user.packageForm');
        } else {
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
                $vacancy->mode_id = $request->mode;
                $vacancy->education_id = $request->education;
                $vacancy->experience_id = $request->experience;
                $vacancy->company_type = CompanyEnum::COMPANY;
                $vacancy->company = $request->company;
                $vacancy->relevant_people = $request->relevant_people;
                $vacancy->candidate_requirement = $request->candidate_requirements;
                $vacancy->job_description = $request->about_job;
                $vacancy->tags = $request->tags;
                $vacancy->admin_status = VacancyAdminEnum::Pending;
                $vacancy->admin_id = 0;
                vacancy_time($vacancy);
                $vacancy->save();
                auth()->guard('admin')->user()->package()->first()->pivot->decrement('current_ads_count');
                if (auth()->guard('admin')->user()->package()->first()->pivot->current_ads_count == 0) {
                    auth()->guard('admin')->user()->package()->first()->delete();
                }
                return redirect()->route('user.item.index');
            } catch (Exception $exception) {
                alert()->error(__('messages.error'));
                return redirect(route('frontend.new-vacancy'));
            }
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
