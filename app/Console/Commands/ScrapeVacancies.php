<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeVacancies extends Command
{
    protected $signature = 'scrape:vacancies';

    protected $description = 'Scrape vacancies from boss.az and store as JSON';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): \Illuminate\Http\JsonResponse
    {
        $url = 'https://boss.az/vacancies';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $vacancies = $crawler->filter('.results-i')->each(function ($node) {
            $position = $node->filter('td')->eq(0)->text();
            $company = $node->filter('td')->eq(1)->text();
            $salary = $node->filter('td')->eq(3)->text();
            $details = $node->filter('td')->eq(4)->filter('a')->attr('href');
            $location = $node->filter('td')->eq(5)->text();

            return compact('position', 'company', 'salary', 'details', 'location');
        });

        return response()->json(['vacancies' => $vacancies]);
//        // Send a GET request to the website
//        $url = 'https://boss.az/vacancies';
//        $client = new Client();
//        $response = $client->get($url);
//        $content = $response->getBody()->getContents();
//
//        // Parse the HTML content using Symfony's DomCrawler
//        $crawler = new Crawler($content);
//
//        // Extract vacancy details
//        $vacancies = [];
//        $crawler->filter('.vacancies__card')->each(function (Crawler $node) use (&$vacancies) {
//            $title = $node->filter('.vacancies__card-title')->text();
//            $company = $node->filter('.vacancies__card-company')->text();
//            $location = $node->filter('.vacancies__card-location')->text();
//            $salary = $node->filter('.vacancies__card-salary')->text();
//
//            $vacancies[] = [
//                'title' => $title,
//                'company' => $company,
//                'location' => $location,
//                'salary' => $salary,
//            ];
//        });
//
//        // Store vacancies as JSON
//        $json = json_encode($vacancies, JSON_PRETTY_PRINT);
//        file_put_contents(public_path('vacancies.json'), $json);
//
//        $this->info('Vacancies scraped and stored as JSON successfully!');
    }
}
