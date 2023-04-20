<?php

use App\Models\SiteLanguage;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('upload')) {
    function upload($path, $file)
    {
        try {
            $img = $file;
            $extension = $img->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $img->move('images/' . $path, $filename);
            $data['photo'] = 'images/' . $path . '/' . $filename;
            return $data['photo'];
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('multi_upload')) {
    function multi_upload($path, $files)
    {
        try {
            $result = [];
            foreach ($files as $file) {
                $name = uniqid() . '.' . Str::lower($file->extension());
                $file->move("images/$path", $name);
                $result[] = "$path/$name";
            }
            return $result;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('cv_upload')) {
    function cv_upload($file, $cvName)
    {
        try {
            $img = $file;
            $extension = $img->getClientOriginalExtension();
            $filename = $cvName . '.' . $extension;
            $img->move('cv', $filename);
            $data['cv'] = 'cv/' . $filename;
            return $data['cv'];
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('active_langs')) {
    function active_langs()
    {
        return SiteLanguage::where('status', 1)->get();
    }
}

if (!function_exists('settings')) {
    function settings($name)
    {
        return Setting::where('name', $name)->value('link');
    }
}

if (!function_exists('statistic')) {
    function statistic($name)
    {
        return \App\Models\Statistics::where('name', $name)->value('count');
    }
}

if (!function_exists('validation_m')) {
    function validation_m($name)
    {
        return '<div class="valid-feedback">' . __($name) . ' ' . __('messages.is-correct') . '</div><div class="invalid-feedback">' . __($name) . ' ' . __('messages.not-correct') . '</div>';
    }
}

if (!function_exists('vacancy_tags')) {
    function vacancy_tags($tags)
    {
        try {
            $tagsArray = [];
            $array = json_decode($tags);
            foreach ($array as $t) {
                array_push($tagsArray, $t->value);
            }
            return $tagsArray;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('vacancy_time')) {
    function vacancy_time($vacancy)
    {
        $vacancy->start_time = Carbon::now();
        $vacancy->end_time = Carbon::now()->addDay(settings('vacancy_day'));
    }
}

if (!function_exists('convert_number')) {
    function convert_number($value)
    {
        if ($value >= 1000 and $value < 1000000) {
            return round($value / 1000, 0) . 'k';
        }
        if ($value >= 1000000) {
            return round($value / 1000000, 0) . 'M';
        } else {
            return $value;
        }
    }
}
