<?php

namespace Database\Seeders;

use App\Models\Mode;
use App\Models\ModeTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder
{
    public function run()
    {
        $modes = [
            ['az' => 'Tam ştat', 'en' => 'Full time', 'ru' => 'На постоянной основе'],
            ['az' => 'Frinlans', 'en' => 'Freelance', 'ru' => 'Фриланс'],
            ['az' => 'Yarım ştat', 'en' => 'Part time', 'ru' => 'Неполная занятость'],
            ['az' => 'Təcrübəçi', 'en' => 'Intern', 'ru' => 'Стажер'],
        ];
        foreach ($modes as $mode) {
            $newmode = new Mode();
            $newmode->save();
            foreach ($mode as $key => $item) {
                $translation = new ModeTranslation();
                $translation->locale = $key;
                $translation->mode_id = $newmode->id;
                $translation->name = $item;
                $translation->save();
            }
        }
    }
}
