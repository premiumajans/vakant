<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\TermTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    public function run()
    {
        $term = new Term();
        $term->save();
        foreach (active_langs() as $lang) {
            $termTranslation = new TermTranslation();
            $termTranslation->locale = $lang->code;
            $termTranslation->description = 'example terms';
            $termTranslation->term_id = $term->id;
            $termTranslation->save();
        }
    }
}
