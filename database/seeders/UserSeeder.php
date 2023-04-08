<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Vakant',
            'email' => 'admin@vakant.az',
            'password' => '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm' //Password
        ]);
        $developer = User::create([
            'name' => 'Developer Vakant',
            'email' => 'developer@vakant.az',
            'password' => '$2y$10$hcn0QuYc5NOiKrjaNMGNIeITHW3bzJ6UeTVWWg/1ZaFQ8eXX1Incm', //Password
        ]);
        $admin->givePermissionTo(Permission::all());
        $developer->givePermissionTo(Permission::all());
    }
}
