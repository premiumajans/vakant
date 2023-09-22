<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            ['ads_count' => 1, 'monthly_payment' => 10, 'status' => 1, 'translations' => ['az' => 'Standart', 'en' => 'Standart', 'ru' => 'Стандарт']],
            ['ads_count' => 3, 'monthly_payment' => 40, 'status' => 1, 'translations' => ['az' => 'Biznes', 'en' => 'Business', 'ru' => 'Бизнес']],
            ['ads_count' => 10, 'monthly_payment' => 120, 'status' => 1, 'translations' => ['az' => 'Premium', 'en' => 'Premium', 'ru' => 'Премиум']],
        ];
        foreach ($packages as $package) {
            $pack = new Package();
            $pack->ads_count = $package['ads_count'];
            $pack->monthly_payment = $package['monthly_payment'];
            $pack->status = $package['status'];
            $pack->save();
            foreach ($package['translations'] as $key => $packageTranslation) {
                $packTranslation = new PackageTranslation();
                $packTranslation->locale = $key;
                $packTranslation->title = $packageTranslation;
                $packTranslation->package_id = $pack->id;
                $packTranslation->save();
            }
        }
    }
}
