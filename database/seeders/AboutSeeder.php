<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run()
    {
        $about = new About();
        $about->save();
        foreach (active_langs() as $lang) {
            $trans = new AboutTranslation();
            $trans->about_id = $about->id;
            $trans->content = 'Lorem standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ';
            $trans->locale = $lang->code;
            $trans->save();
        }
    }
}
