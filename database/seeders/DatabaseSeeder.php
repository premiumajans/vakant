<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\Admin;
use App\Models\MetaTag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            CategorySeeder::class,
            CitySeeder::class,
            ModeSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            SalarySeeder::class,
            AdminSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            PackageSeeder::class,
            TermSeeder::class,
        ]);
    }
}
