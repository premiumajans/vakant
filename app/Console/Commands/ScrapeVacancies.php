<?php


namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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
        $vacancies = $this->scrapeVacancies($url);

        return response()->json(['vacancies' => $vacancies]);
    }

    /**
     * @throws GuzzleException
     */
    private function scrapeVacancies(string $url): Collection
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        return $crawler->filter('.results-i')->map(function ($node) {
            return [
                'position' => $node->filter('td')->eq(0)->text(),
                'company' => $node->filter('td')->eq(1)->text(),
                'salary' => $node->filter('td')->eq(3)->text(),
                'details' => $node->filter('td')->eq(4)->filter('a')->attr('href'),
                'location' => $node->filter('td')->eq(5)->text(),
            ];
        });
    }
}
