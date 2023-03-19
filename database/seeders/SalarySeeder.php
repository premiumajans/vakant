<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Salary;
use App\Models\SalaryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    public function run()
    {
        $salaries = [
            '100' => ['az' => 'minimum 100 AZN', 'en' => 'at least 100 AZN', 'ru' => 'от 100 AZN'],
            '200' => ['az' => 'minimum 200 AZN', 'en' => 'at least 200 AZN', 'ru' => 'от 200 AZN'],
            '300' => ['az' => 'minimum 300 AZN', 'en' => 'at least 300 AZN', 'ru' => 'от 300 AZN'],
            '400' => ['az' => 'minimum 400 AZN', 'en' => 'at least 400 AZN', 'ru' => 'от 400 AZN'],
            '500' => ['az' => 'minimum 500 AZN', 'en' => 'at least 500 AZN', 'ru' => 'от 500 AZN'],
            '600' => ['az' => 'minimum 600 AZN', 'en' => 'at least 600 AZN', 'ru' => 'от 600 AZN'],
            '700' => ['az' => 'minimum 700 AZN', 'en' => 'at least 700 AZN', 'ru' => 'от 700 AZN'],
            '800' => ['az' => 'minimum 800 AZN', 'en' => 'at least 800 AZN', 'ru' => 'от 800 AZN'],
            '900' => ['az' => 'minimum 900 AZN', 'en' => 'at least 900 AZN', 'ru' => 'от 900 AZN'],
            '1000' => ['az' => 'minimum 1000 AZN', 'en' => 'at least 1000 AZN', 'ru' => 'от 1000 AZN'],
            '1100' => ['az' => 'minimum 1100 AZN', 'en' => 'at least 1100 AZN', 'ru' => 'от 1100 AZN'],
            '1200' => ['az' => 'minimum 1200 AZN', 'en' => 'at least 1200 AZN', 'ru' => 'от 1200 AZN'],
            '1300' => ['az' => 'minimum 1300 AZN', 'en' => 'at least 1300 AZN', 'ru' => 'от 1300 AZN'],
            '1400' => ['az' => 'minimum 1400 AZN', 'en' => 'at least 1400 AZN', 'ru' => 'от 1400 AZN'],
            '1500' => ['az' => 'minimum 1500 AZN', 'en' => 'at least 1500 AZN', 'ru' => 'от 1500 AZN'],
            '1600' => ['az' => 'minimum 1600 AZN', 'en' => 'at least 1600 AZN', 'ru' => 'от 1600 AZN'],
            '1700' => ['az' => 'minimum 1700 AZN', 'en' => 'at least 1700 AZN', 'ru' => 'от 1700 AZN'],
            '1800' => ['az' => 'minimum 1800 AZN', 'en' => 'at least 1800 AZN', 'ru' => 'от 1800 AZN'],
            '1900' => ['az' => 'minimum 1900 AZN', 'en' => 'at least 1900 AZN', 'ru' => 'от 1900 AZN'],
            '2000' => ['az' => 'minimum 2000 AZN', 'en' => 'at least 2000 AZN', 'ru' => 'от 2000 AZN'],
            '2100' => ['az' => 'minimum 2100 AZN', 'en' => 'at least 2100 AZN', 'ru' => 'от 2100 AZN'],
            '2200' => ['az' => 'minimum 2200 AZN', 'en' => 'at least 2200 AZN', 'ru' => 'от 2200 AZN'],
            '2300' => ['az' => 'minimum 2300 AZN', 'en' => 'at least 2300 AZN', 'ru' => 'от 2300 AZN'],
            '2400' => ['az' => 'minimum 2400 AZN', 'en' => 'at least 2400 AZN', 'ru' => 'от 2400 AZN'],
            '2500' => ['az' => 'minimum 2500 AZN', 'en' => 'at least 2500 AZN', 'ru' => 'от 2500 AZN'],
            '2600' => ['az' => 'minimum 2600 AZN', 'en' => 'at least 2600 AZN', 'ru' => 'от 2600 AZN'],
            '2700' => ['az' => 'minimum 2700 AZN', 'en' => 'at least 2700 AZN', 'ru' => 'от 2700 AZN'],
            '2800' => ['az' => 'minimum 2800 AZN', 'en' => 'at least 2800 AZN', 'ru' => 'от 2800 AZN'],
            '2900' => ['az' => 'minimum 2900 AZN', 'en' => 'at least 2900 AZN', 'ru' => 'от 2900 AZN'],
            '3000' => ['az' => 'minimum 3000 AZN', 'en' => 'at least 3000 AZN', 'ru' => 'от 3000 AZN'],
            '3100' => ['az' => 'minimum 3100 AZN', 'en' => 'at least 3100 AZN', 'ru' => 'от 3100 AZN'],
            '3200' => ['az' => 'minimum 3200 AZN', 'en' => 'at least 3200 AZN', 'ru' => 'от 3200 AZN'],
            '3300' => ['az' => 'minimum 3300 AZN', 'en' => 'at least 3300 AZN', 'ru' => 'от 3300 AZN'],
            '3400' => ['az' => 'minimum 3400 AZN', 'en' => 'at least 3400 AZN', 'ru' => 'от 3400 AZN'],
            '3500' => ['az' => 'minimum 3500 AZN', 'en' => 'at least 3500 AZN', 'ru' => 'от 3500 AZN'],
            '3600' => ['az' => 'minimum 3600 AZN', 'en' => 'at least 3600 AZN', 'ru' => 'от 3600 AZN'],
            '3700' => ['az' => 'minimum 3700 AZN', 'en' => 'at least 3700 AZN', 'ru' => 'от 3700 AZN'],
            '3800' => ['az' => 'minimum 3800 AZN', 'en' => 'at least 3800 AZN', 'ru' => 'от 3800 AZN'],
            '3900' => ['az' => 'minimum 3900 AZN', 'en' => 'at least 3900 AZN', 'ru' => 'от 3900 AZN'],
            '4000' => ['az' => 'minimum 4000 AZN', 'en' => 'at least 4000 AZN', 'ru' => 'от 4000 AZN'],
            '5000' => ['az' => 'minimum 5000 AZN', 'en' => 'at least 5000 AZN', 'ru' => 'от 5000 AZN'],
            '6000' => ['az' => 'minimum 6000 AZN', 'en' => 'at least 6000 AZN', 'ru' => 'от 6000 AZN'],
            '7000' => ['az' => 'minimum 7000 AZN', 'en' => 'at least 7000 AZN', 'ru' => 'от 7000 AZN'],
            '8000' => ['az' => 'minimum 8000 AZN', 'en' => 'at least 8000 AZN', 'ru' => 'от 8000 AZN'],
            '9000' => ['az' => 'minimum 9000 AZN', 'en' => 'at least 9000 AZN', 'ru' => 'от 9000 AZN'],
            '10000' => ['az' => 'minimum 10000 AZN', 'en' => 'at least 10000 AZN', 'ru' => 'от 10000 AZN'],
            '11000' => ['az' => 'minimum 11000 AZN', 'en' => 'at least 11000 AZN', 'ru' => 'от 11000 AZN'],
            '12000' => ['az' => 'minimum 12000 AZN', 'en' => 'at least 12000 AZN', 'ru' => 'от 12000 AZN'],
            '13000' => ['az' => 'minimum 13000 AZN', 'en' => 'at least 13000 AZN', 'ru' => 'от 13000 AZN'],
            '14000' => ['az' => 'minimum 14000 AZN', 'en' => 'at least 14000 AZN', 'ru' => 'от 14000 AZN'],


        ];
        foreach ($salaries as $key2 => $salary) {
            $c = new Salary();
            $c->salary = $key2;
            $c->save();
            foreach ($salary as $key => $lang) {
                $translation = new SalaryTranslation();
                $translation->locale = $key;
                $translation->salary_id = $c->id;
                $translation->name = $lang;
                $translation->save();
            }

        }
    }
}
