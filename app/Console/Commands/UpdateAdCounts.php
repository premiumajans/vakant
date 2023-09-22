<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateAdCounts extends Command
{
    protected $signature = 'adcounts:update';
    protected $description = 'Update the current_ad_count for all users every month';
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            $createdDate = Carbon::parse($user->created_at);
            $currentDate = Carbon::now();
            $daysDiff = $createdDate->diffInDays($currentDate);
            if ($daysDiff % 30 == 0) {
                $user->current_ad_count += 1;
                $user->save();
            }
        }
        $this->info('Current ad count updated for all users.');
    }
}
