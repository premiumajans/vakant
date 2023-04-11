<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\VacancyDescription;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function _addNewVacancy($vacancy, $request){
        $vacancyDescription = new VacancyDescription();
        $vacancyDescription->vacancy_id = $vacancy->id;
        $vacancyDescription->relevant_people = $request->relevant_people;
        $vacancyDescription->candidate_requirement = $request->candidate_requirements;
        $vacancyDescription->job_description = $request->about_job;
        $vacancyDescription->tags = $request->tags;
        $vacancyDescription->company = $request->company;
        $vacancyDescription->email = $request->email;
        $vacancyDescription->phone = $request->phone;
        $vacancyDescription->position = $request->position;
        $vacancyDescription->category_id = $request->category;
        $vacancyDescription->max_salary = $request->maximum_salary;
        $vacancyDescription->min_salary = $request->minimum_salary;
        $vacancyDescription->max_age = $request->maximum_age;
        $vacancyDescription->min_age = $request->minimum_age;
        $vacancyDescription->city_id = $request->city;
        $vacancyDescription->mode_id = $request->mode;
        $vacancyDescription->education_id = $request->education;
        $vacancyDescription->experience_id = $request->experience;
        $vacancy->description()->save($vacancyDescription);
    }

}
