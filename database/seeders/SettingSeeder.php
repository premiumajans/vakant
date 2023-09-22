<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $set = [
            ['name' => "vacancy_day", 'link' => 30],
            ['name' => "facebook", 'link' => "https://facebook.com/"],
            ['name' => "linkedin", 'link' => "https://linkedin.com/in/"],
            ['name' => "instagram", 'link' => "https://instagram.com/"],
            ['name' => "email", 'link' => "adm@turquoise-az.com"],
            ['name' => "whatsapp", 'link' => "+99470 224 80 59"],
            ['name' => "location", 'link' => "TURQUOISE MMC Hökməli qəsəbəsi, Bakı-Şamaxı yolu, 16-cı km"],
            ['name' => "location_link", 'link' => "https://goo.gl/maps/8FrLi6UffGdMhrMs6"],
            ['name' => "phone", 'link' => "+99470 224 80 59"],
        ];
        Setting::insert($set);
    }
}
