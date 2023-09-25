<?php


namespace App\Utils\Services;

use App\Models\Vacancy;
use App\Utils\Enums\CauserEnum;
use App\Utils\Enums\VacancyAdminEnum;
use App\Utils\Enums\VacancyEnum;

class VacancyScrapingService
{
    private ScarpingService $scarpingService;
    private CreateVacancyService $createVacancyService;

    public function __construct(ScarpingService $scrapingService, CreateVacancyService $createVacancyService)
    {
        $this->scarpingService = $scrapingService;
        $this->createVacancyService = $createVacancyService;
    }

//    public function scrape(): array
//    {
//        $baseURL = 'https://boss.az/vacancies?action=index&controller=vacancies&only_path=true&page=%d&type=vacancies';
//        $vacancies = [];
//        for ($page = 1; $page <= 35; $page++) {
//            $url = sprintf($baseURL, $page);
//            $html = file_get_contents($url);
//            $pageVacancies = $this->scrapeData($html);
//            $vacancies = array_merge($vacancies, $pageVacancies);
//        }
//        return $this->addVacancyUrls($vacancies);
//    }
    public function scrape(): array
    {
        $baseURL = 'https://boss.az/vacancies?action=index&controller=vacancies&only_path=true&page=%d&type=vacancies';
        $vacancies = [];
        $page = 1;

        while (true) {
            $url = sprintf($baseURL, $page);
            $html = file_get_contents($url);
            $pageVacancies = $this->scrapeData($html);
            if (empty($pageVacancies)) {
                break;
            }
            $vacancies = array_merge($vacancies, $pageVacancies);
            $page++;
        }
        return $this->addVacancyUrls($vacancies);
    }

    private function scrapeData($html): array
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors(false);
        if (!empty($errors)) {
            foreach ($errors as $error) {
                error_log($error->message);
            }
        }
        $vacancies = [];
        $anchorElements = $dom->getElementsByTagName('a');
        foreach ($anchorElements as $anchorElement) {
            if ($anchorElement->getAttribute('class') === 'results-i-link') {
                $link = $anchorElement->getAttribute('href');
                $vacancies[] = [
                    'advert_id' => str_replace('/vacancies/', '', $link),
                ];
            }
        }
        return $vacancies;
    }

    private function addVacancyUrls($vacancies): array
    {
        $baseURL = 'https://boss.az/vacancies/';
        $vacancyIDs = Vacancy::get()->pluck('scrap_id')->toArray();
        $vacanciesWithUrls = [];
        foreach ($vacancies as $key => $vacancy) {
            if (!in_array($vacancy['advert_id'], $vacancyIDs)) {
                $vacancyUrl = $baseURL . $vacancy['advert_id'];
                $html = file_get_contents($vacancyUrl);
                $scrapedVacancy = $this->scarpingService->scrapeData($html);
                $vacanciesWithUrls[] = $scrapedVacancy;
                $vacancyDetails = [
                    'causer_type' => CauserEnum::SCRAPING,
                    'causer_id' => 0,
                    'scrap_id' => $vacancy['advert_id'],
                    'admin_status' => VacancyAdminEnum::Approved,
                    'vacancy_type' => (strpos($vacancy['advert_id'], '-p') !== false) ? VacancyEnum::PREMIUM : VacancyEnum::SIMPLE,
                    'shared_time' => $scrapedVacancy['start_time'],
                    'start_time' => $scrapedVacancy['start_time'],
                    'end_time' => $scrapedVacancy['end_time'],
                ];
                $this->createVacancyService->createVacancy($scrapedVacancy, $vacancyDetails);
            }
        }
        return $vacanciesWithUrls;
    }
}
