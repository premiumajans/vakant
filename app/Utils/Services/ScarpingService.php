<?php


namespace App\Utils\Services;

use App\Models\AltCategory;
use App\Models\CategoryTranslation;
use App\Models\CityTranslation;
use App\Models\EducationTranslation;
use App\Models\ExperienceTranslation;
use DateTime;

class ScarpingService
{
    public function scrapeData($html): array
    {
        return [
            'position' => $this->extractData($html, '/<h1 class="post-title">(.+?)<\/h1>/s'),
            'company' => $this->extractData($html, '/<a class="post-company" href=".+?">(.+?)<\/a>/s'),
            'city' => $this->getLocationID($html),
            'experience' => $this->getExperienceID($html),
            'education' => $this->getEducationID($html),
            'maximum_salary' => $this->getMaximumSalary($html),
            'minimum_salary' => $this->getMinimumSalary($html),
            'minimum_age' => $this->getMinimumAge($html),
            'maximum_age' => $this->getMaximumAge($html),
            'category_id' => $this->getCategoryID($html),
            'start_time' => $this->convertDate($this->extractData($html, '/<div class="bumped_on params-i-val">(.+?)<\/div>/s')),
            'end_time' => $this->convertDate($this->extractData($html, '/<div class="expires_on params-i-val">(.+?)<\/div>/s')),
            'relevant_people' => $this->extractData($html, '/<div class="contact params-i-val">(.+?)<\/div>/s'),
            'email' => 'email',
            'phone' => strip_tags($this->extractData($html, '/<div class="phone params-i-val">(.+?)<\/div>/s')),
            'about_job' => strip_tags($this->extractData($html, '/<dd class="job_description params-i-val">(.+?)<\/div>/s')),
            'candidate_requirements' => strip_tags($this->extractData($html, '/<dd class="requirements params-i-val">(.+?)<\/div>/s')),
        ];
    }

    private function extractData($html, $regex): string
    {
        preg_match($regex, $html, $matches);
        return isset($matches[1]) ? trim($matches[1]) : '';
    }

    private function getLocationID($html)
    {
        $location = $this->extractData($html, '/<div class="region params-i-val">(.+?)<\/div>/s');
        return CityTranslation::where('name', $location)->value('id');
    }

    private function getExperienceID($html)
    {
        $experience = $this->extractData($html, '/<div class="experience params-i-val">(.+?)<\/div>/s');
        return ExperienceTranslation::where('name', $experience)->value('experience_id');
    }

    private function getEducationID($html)
    {
        $education = $this->extractData($html, '/<div class="education params-i-val">(.+?)<\/div>/s');
        return EducationTranslation::where('name', $education)->value('education_id');
    }

    private function getMaximumSalary($html): int
    {
        $salary = $this->extractData($html, '/<span class="post-salary salary">(.+?)<\/span>/s');
        $selectedSalaries = array_map('intval', explode(" - ", $salary));
        return $selectedSalaries[1] ?? $selectedSalaries[0];
    }

    private function getMinimumSalary($html): int
    {
        $salary = $this->extractData($html, '/<span class="post-salary salary">(.+?)<\/span>/s');
        $selectedSalaries = array_map('intval', explode(" - ", $salary));
        return $selectedSalaries[0];
    }

    private function getMinimumAge($html): int
    {
        $age = $this->extractData($html, '/<div class="age params-i-val">(.+?)<\/div>/s');
        $selectedAges = array_map('intval', explode(" - ", $age));
        return $selectedAges[0];
    }

    private function getMaximumAge($html): int
    {
        $age = $this->extractData($html, '/<div class="age params-i-val">(.+?)<\/div>/s');
        $selectedAges = array_map('intval', explode(" - ", $age));
        return $selectedAges[1] ?? $selectedAges[0];
    }

    private function getCategoryID($html)
    {
        $category = $this->extractData($html, '/<div class="breadcrumbs">(.+?)<\/div>/s');
        $catArray = explode(' / ', strip_tags($category));
        $categoryID = CategoryTranslation::where('name', $catArray[0])->value('category_id');
        return AltCategory::where('category_id', $categoryID)
            ->whereHas('translation', function ($query) use ($catArray) {
                $query->where('name', $catArray[1]);
            })
            ->value('id');
    }

    private function convertDate($inputDate): string
    {
        $dateTime = [
            'Yanvar' => 'Jan', 'Fevral' => 'Feb', 'Mart' => 'Mar', 'Aprel' => 'Apr',
            'May' => 'May', 'İyun' => 'Jun', 'İyul' => 'Jul', 'Avqust' => 'Aug',
            'Sentyabr' => 'Sep', 'Oktyabr' => 'Oct', 'Noyabr' => 'Nov', 'Dekabr' => 'Dec',
        ];

        if (preg_match('/^(\w+) (\d+), (\d+)$/', $inputDate, $matches)) {
            $monthText = $matches[1];
            $day = $matches[2];
            $year = $matches[3];
            $englishMonth = $dateTime[$monthText] ?? 'January';
            $inputDateTime = new DateTime("$englishMonth $day, $year");
            return $inputDateTime->format('Y-m-d H:i:s');
        } else {
            return "Invalid input format";
        }
    }
}
