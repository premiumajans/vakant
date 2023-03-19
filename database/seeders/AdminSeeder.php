<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin Vakant',
            'email' => 'admin@vakant.az',
            'password' => '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm' //Password
        ]);
        $developer = Admin::create([
            'name' => 'Developer Vakant',
            'email' => 'developer@vakant.az',
            'password' => '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', //Password
        ]);
        $admin->givePermissionTo(Permission::all());
        $developer->givePermissionTo(Permission::all());
    }
}
