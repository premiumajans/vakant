<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\Services\ScarpingService;
use App\Utils\Services\VacancyScrapingService;

class ScarpingController extends Controller
{
    private VacancyScrapingService $vacancyScrapingService;
    public function __construct( VacancyScrapingService $vacancyScrapingService)
    {
        $this->vacancyScrapingService = $vacancyScrapingService;
    }

    public function scrape()
    {
        $this->vacancyScrapingService->scrape();
    }
}
