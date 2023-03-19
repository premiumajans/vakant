<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\ExperienceTranslation;
use App\Models\Salary;
use App\Models\SalaryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run()
    {
        $salaries = [
            ['az' => 'Vacib deyil', 'en' => 'Any', 'ru' => 'Не имеет значения'],
            ['az' => '1 ildən aşağı', 'en' => 'Less than 1 year', 'ru' => 'Менее 1 года'],
            ['az' => '1 ildən 3 ilə qədər', 'en' => 'from 1 to 3 years', 'ru' => 'От 1 года до 3 лет'],
            ['az' => '3 ildən 5 ilə qədər', 'en' => 'from 3 to 5 years', 'ru' => 'От 3 до 5 лет'],
            ['az' => '5 ildən artıq', 'en' => 'More than 5 years', 'ru' => 'Более 5 лет'],
        ];
        foreach ($salaries as $salary) {
            $c = new Experience();
            $c->save();
            foreach ($salary as $key => $lang) {
                $translation = new ExperienceTranslation();
                $translation->locale = $key;
                $translation->experience_id = $c->id;
                $translation->name = $lang;
                $translation->save();
            }
        }
    }
}
