<?php

namespace App\Services;

use App\Http\Enums\VacancyEnum;
use App\Http\Helpers\EmailDecodeHelper;
use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\CategoryTranslation;
use App\Models\CityTranslation;
use App\Models\EducationTranslation;
use App\Models\ExperienceTranslation;
use App\Models\PremiumVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;
use V8Js;

class ScarpingService
{
    public function scrapeData($html): array
    {
        $dateTime = ['Yanvar' => 'Jan', 'Fevral' => 'Feb', 'Mart' => 'Mar', 'Aprel' => 'Apr', 'May' => 'May', 'İyun' => 'Jun', 'İyul' => 'Jul', 'Avqust' => 'Aug', 'Sentyabr' => 'Sep', 'Oktabr' => 'Oct', 'Noyabr' => 'Nov', 'Dekabr' => 'Dec'];
        $position = $this->extractData($html, '/<h1 class="post-title">(.+?)<\/h1>/s');
        $company = $this->extractData($html, '/<a class="post-company" href=".+?">(.+?)<\/a>/s');
        $location = $this->extractData($html, '/<div class="region params-i-val">(.+?)<\/div>/s');
        $category = $this->extractData($html, '/<div class="breadcrumbs">(.+?)<\/div>/s');
        $catArray = explode(' / ', strip_tags($category));
        $salary = $this->extractData($html, '/<span class="post-salary salary">(.+?)<\/span>/s');
        $education = $this->extractData($html, '/<div class="education params-i-val">(.+?)<\/div>/s');
        $experience = $this->extractData($html, '/<div class="experience params-i-val">(.+?)<\/div>/s');
        $age = $this->extractData($html, '/<div class="age params-i-val">(.+?)<\/div>/s');
        $start_time = $this->extractData($html, '/<div class="bumped_on params-i-val">(.+?)<\/div>/s');
        $end_time = $this->extractData($html, '/<div class="expires_on params-i-val">(.+?)<\/div>/s');
        $relevantPeople = $this->extractData($html, '/<div class="contact params-i-val">(.+?)<\/div>/s');
        $email = $this->extractData($html, '/<div class="email params-i-val">(.+?)<\/div>/s');
        $phone = $this->extractData($html, '/<div class="phone params-i-val">(.+?)<\/div>/s');
        $description = $this->extractData($html, '/<dd class="job_description params-i-val">(.+?)<\/div>/s');
        $requirements = $this->extractData($html, '/<dd class="requirements params-i-val">(.+?)<\/div>/s');
        $locationID = CityTranslation::where('name', $location)->get()->value('id');
        $experienceID = ExperienceTranslation::where('name', $experience)->get()->value('experience_id');
        $educationID = EducationTranslation::where('name', $education)->get()->value('education_id');
        $categoryID = CategoryTranslation::where('name', $catArray[0])->get()->value('category_id');
        $altCategoryID = AltCategory::where('category_id', '=', $categoryID)
            ->whereHas('translation', function ($query) use ($catArray) {
                $query->where('name', $catArray[1]);
            })
            ->get()
            ->value('id');
        $selectedAges = [];
        $selectedSalaries = [];
        foreach (explode(" - ", $age) as $number) {
            $selectedAges[] = (int)$number;
        }
        foreach (explode(" - ", $salary) as $oneSalary) {
            $selectedSalaries[] = (int)$oneSalary;
        }
        return [
            'position' => $position,
            'company' => $company,
            'city' => $locationID,
            'experience' => $experienceID,
            'education' => $educationID,
            'minimum_age' => $selectedAges[0],
            'maximum_age' => $selectedAges[1] ?? $selectedAges[0],
            'minimum_salary' => $selectedSalaries[0],
            'maximum_salary' => $selectedSalaries[1] ?? $selectedSalaries[0],
            'category_id' => $altCategoryID,
            'start_time' => Carbon::createFromFormat('F d, Y', $dateTime[substr($start_time, 0, strpos($start_time, ' '))] . ' ' . substr($start_time, strpos($start_time, ' ') + 1))->format('Y-m-d H:i:s'),
            'end_time' => Carbon::createFromFormat('F d, Y', $dateTime[substr($end_time, 0, strpos($end_time, ' '))] . ' ' . substr($end_time, strpos($end_time, ' ') + 1))->format('Y-m-d H:i:s'),
            'relevant_people' => $relevantPeople,
            'email' => $email,
            'phone' => strip_tags($phone),
            'about_job' => strip_tags($description),
            'candidate_requirements' => strip_tags($requirements),
        ];
    }

    private function extractData($html, $regex): string
    {
        preg_match($regex, $html, $matches);
        return isset($matches[1]) ? trim($matches[1]) : '';
    }
}
