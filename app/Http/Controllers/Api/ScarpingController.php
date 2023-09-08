<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Http\Enums\VacancyEnum;
use App\Models\Vacancy;
use App\Models\VacancyDescription;
use App\Services\ScarpingService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\UriResolver;

class ScarpingController extends Controller
{
    private $scrapingService;

    public function __construct(ScarpingService $scrapingService)
    {
        $this->scrapingService = $scrapingService;
    }

    public function scrape()
    {
        $baseURL = 'https://boss.az/vacancies?action=index&controller=vacancies&only_path=true&page=%d&type=vacancies';
        $vacancies = [];
        for ($page = 1; $page <= 35; $page++) {
            $url = sprintf($baseURL, $page);
            $html = file_get_contents($url);
            $pageVacancies = $this->scrapeData($html);
            $vacancies = array_merge($vacancies, $pageVacancies);
        }
        $vacanciesWithUrls = $this->addVacancyUrls($vacancies);
        return response()->json($vacanciesWithUrls);
    }

    private function scrapeData($html)
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
        $jobElements = $dom->getElementsByTagName('div');
        foreach ($jobElements as $jobElement) {
            if ($jobElement->getAttribute('class') === 'results-i') {
                $link = $this->extractData($jobElement, './/a[@class="results-i-link"]', 'href');
                $vacancies[] = [
                    'advert_id' => str_replace('/vacancies/', '', $link),
                ];
            }
        }
        return $vacancies;
    }

    private function extractData($element, $xpathQuery, $attribute = null)
    {
        $xpath = new \DOMXPath($element->ownerDocument);
        $data = '';
        $nodes = $xpath->query($xpathQuery, $element);
        if ($nodes->length > 0) {
            $node = $nodes->item(0);
            if ($attribute) {
                $data = $node->getAttribute($attribute);
            } else {
                $data = $node->nodeValue;
            }
        }
        return trim($data);
    }

    private function addVacancyUrls($vacancies)
    {
//        $baseURL = 'https://boss.az/vacancies/';
//        $vacanciesWithUrls = [];
//        $vacancyUrl = $baseURL . '213737';
//        $html = file_get_contents($vacancyUrl);
//        $scrapedVacancy = $this->scrapingService->scrapeData($html);
//        $vacanciesWithUrls[] = $scrapedVacancy;
//        return $vacanciesWithUrls;

        $baseURL = 'https://boss.az/vacancies/';
        $vacanciesWithUrls = [];
        foreach ($vacancies as $key => $vacancy) {
            $vacancyUrl = $baseURL . $vacancy['advert_id'];
            $html = file_get_contents($vacancyUrl);
            $scrapedVacancy = $this->scrapingService->scrapeData($html);
            $vacanciesWithUrls[] = $scrapedVacancy;
            $newVacancy = new Vacancy();
            $newVacancy->causer_type = CauserEnum::SCRAPING;
            $newVacancy->causer_id = 0;
            $newVacancy->scrap_id = $vacancy['advert_id'];
            $newVacancy->admin_status = VacancyAdminEnum::Approved;
            $newVacancy->vacancy_type = (strpos($vacancy['advert_id'], '-p') !== false) ? VacancyEnum::PREMIUM : VacancyEnum::SIMPLE;
            $newVacancy->shared_time = $scrapedVacancy['start_time'];
            $newVacancy->admin_status = 1;
            $newVacancy->approved_time = $scrapedVacancy['start_time'];
            $newVacancy->end_time = $scrapedVacancy['end_time'];
            $newVacancy->save();
            $vacancyDescription = new VacancyDescription();
            $vacancyDescription->vacancy_id =$newVacancy->id;
//          $vacancyDescription->email = $newVacancy['email'];
            $vacancyDescription->email = 'email';
            $vacancyDescription->category_id = $scrapedVacancy['category_id'] ?? 1;
            $vacancyDescription->phone = $scrapedVacancy['phone'];
            $vacancyDescription->job_description = $scrapedVacancy['about_job'];
            $vacancyDescription->candidate_requirement = $scrapedVacancy['candidate_requirements'];
            $vacancyDescription->relevant_people = $scrapedVacancy['relevant_people'];
            $vacancyDescription->company = $scrapedVacancy['company'];
            $vacancyDescription->city_id = $scrapedVacancy['city'] ?? 1;
            $vacancyDescription->education_id = $scrapedVacancy['education'] ?? 1;
            $vacancyDescription->experience_id = $scrapedVacancy['experience'] ?? 1;
            $vacancyDescription->mode_id = $scrapedVacancy['mode'] ?? 1;
            $vacancyDescription->position = $scrapedVacancy['position'];
            $vacancyDescription->max_salary = $scrapedVacancy['maximum_salary'];
            $vacancyDescription->min_salary = $scrapedVacancy['minimum_salary'];
            $vacancyDescription->max_age = $scrapedVacancy['maximum_age'];
            $vacancyDescription->min_age = $scrapedVacancy['minimum_age'];
            $newVacancy->description()->save($vacancyDescription);
        }
        return $vacanciesWithUrls;
    }
}
