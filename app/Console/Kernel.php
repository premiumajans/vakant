<?php

namespace App\Console;

use App\Console\Commands\Scraping\AddNewVacancy;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:add-new-vacancy')->hourly();
        $schedule->command('app:add-new-vacancy')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
    protected $commands = [
        AddNewVacancy::class,
    ];
}
