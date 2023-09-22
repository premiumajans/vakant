<?php

namespace App\Console\Commands;

use App\Http\Enums\{CauserEnum, VacancyAdminEnum, VacancyEnum};
use App\Models\{Vacancy, VacancyDescription};
use App\Utils\Services\ScarpingService;
use Illuminate\Console\Command;

class AddNewVacancy extends Command
{
    protected $signature = 'app:add-new-vacancy';
    private ScarpingService $scrapingService;

    public function __construct(ScarpingService $scrapingService)
    {
        parent::__construct();
        $this->scrapingService = $scrapingService;
    }

    public function handle(): void
    {

    }

}
