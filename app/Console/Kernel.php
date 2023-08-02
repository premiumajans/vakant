<?php

namespace App\Console;

use App\Console\Commands\Scraping\AddNewVacancy;
use App\Services\VacancyScrapingService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AddNewVacancy::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('app:add-new-vacancy')->hourly();
        $schedule->command('app:add-new-vacancy')->everyMinute();
//        $schedule->call(function () {
//            $service = app(VacancyScrapingService::class);
//            $newVacancyCount = $service->addNewVacancies();
//        })->everyMinute();
    }
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
