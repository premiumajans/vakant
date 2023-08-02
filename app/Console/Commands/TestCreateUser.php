<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TestCreateUser extends Command
{
    protected $signature = 'app:test-create-user';
    protected $description = 'Command description';
    public function handle(): void
    {
        User::create([
            'name' => 'User Vakant',
            'email' => 'shcheld@vakant.az',
            'password' => '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm' //Password
        ]);
    }
}
