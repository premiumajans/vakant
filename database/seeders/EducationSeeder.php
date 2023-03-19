<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\EducationTranslation;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run()
    {
        $salaries = [
            ['az' => 'Vacib deyil', 'en' => 'Any', 'ru' => 'Не имеет значения'],
            ['az' => 'Elmi dərəcə', 'en' => 'Science Degree', 'ru' => 'Научная степень'],
            ['az' => 'Ali', 'en' => 'Higher', 'ru' => 'Высшее'],
            ['az' => 'Natamam ali', 'en' => 'Incomplete Higher', 'ru' => 'Неполное высшее'],
            ['az' => 'Orta texniki', 'en' => 'Secondary Technical', 'ru' => 'Среднее техническое'],
            ['az' => 'Orta xüsusi', 'en' => 'Specialized Secondary', 'ru' => 'Среднее специальное'],
            ['az' => 'Orta', 'en' => 'Secondary', 'ru' => 'Среднее'],
            ['az' => '-', 'en' => '-', 'ru' => '-'],
        ];
        foreach ($salaries as $salary) {
            $c = new Education();
            $c->save();
            foreach ($salary as $key => $lang) {
                $translation = new EducationTranslation();
                $translation->locale = $key;
                $translation->education_id = $c->id;
                $translation->name = $lang;
                $translation->save();
            }
        }
    }
}
