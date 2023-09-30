<?php

namespace App\Utils\Services;

use App\Models\Vacancy;
use App\Models\VacancyDescription;

class CreateVacancyService
{
    public function createVacancy($vacancyData, $vacancyDetails): void
    {
        $newVacancy = new Vacancy();
        $newVacancy->causer_type = $vacancyDetails['causer_type'];
        $newVacancy->causer_id = $vacancyDetails['causer_id'];
        $newVacancy->scrap_id = $vacancyDetails['scrap_id'];
        $newVacancy->admin_status = $vacancyDetails['admin_status'];
        $newVacancy->vacancy_type = $vacancyDetails['vacancy_type'];
        $newVacancy->shared_time = $vacancyData['start_time'];
        $newVacancy->approved_time = $vacancyData['start_time'];
        $newVacancy->end_time = $vacancyData['end_time'];
        $newVacancy->save();
        $this->createVacancyDescription($vacancyData, $newVacancy);
    }

    private function createVacancyDescription($vacancyData, $newVacancy): void
    {
        $vacancyDescription = new VacancyDescription();
        $vacancyDescription->vacancy_id = $newVacancy->id;
        $vacancyDescription->email = $vacancyData['email'] ?? 'email';
        $vacancyDescription->category_id = $vacancyData['category_id'] ?? 1;
        $vacancyDescription->phone = $vacancyData['phone'];
        $vacancyDescription->job_description = $vacancyData['about_job'];
        $vacancyDescription->candidate_requirement = $vacancyData['candidate_requirements'];
        $vacancyDescription->relevant_people = $vacancyData['relevant_people'];
        $vacancyDescription->company = $vacancyData['company'];
        $vacancyDescription->city_id = $vacancyData['city'] ?? 1;
        $vacancyDescription->education_id = $vacancyData['education'] ?? 1;
        $vacancyDescription->experience_id = $vacancyData['experience'] ?? 1;
        $vacancyDescription->mode_id = $vacancyData['mode'] ?? 1;
        $vacancyDescription->position = $vacancyData['position'];
        $vacancyDescription->max_salary = $vacancyData['maximum_salary'];
        $vacancyDescription->min_salary = $vacancyData['minimum_salary'];
        $vacancyDescription->max_age = $vacancyData['maximum_age'];
        $vacancyDescription->min_age = $vacancyData['minimum_age'];
        $vacancyDescription->save();
    }
}
