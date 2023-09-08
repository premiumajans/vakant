<?php

namespace App\Console;
use App\Console\Commands\{AddNewVacancy, UpdateAdCounts};
use Illuminate\{Console\Scheduling\Schedule, Foundation\Console\Kernel as ConsoleKernel};

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AddNewVacancy::class,
        UpdateAdCounts::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('adcounts:update')->everyMinute();
        //$schedule->command('app:add-new-vacancy')->hourly();
        $schedule->command('app:add-new-vacancy')->everyMinute();
    }
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
