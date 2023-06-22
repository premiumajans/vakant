<?php

use App\Models\SiteLanguage;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('upload')) {
    function upload($path, $file)
    {
        try {
            $filename = uniqid() . '.webp';
            Image::make($file)->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
            $data['photo'] = 'images/' . $path . '/' . $filename;
            return $data['photo'];
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
if (!function_exists('api_upload')) {
    function api_upload($path, $file)
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
    function multi_upload($path, $files): array|\Illuminate\Http\RedirectResponse
    {
        try {
            $result = [];
            foreach ($files as $file) {
                $filename = uniqid() . '.webp';
                Image::make($file)->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
                $result[] = "images/$path/$filename";
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
if (!function_exists('checkPermission')) {
    function checkPermission($permission_name)
    {
        return abort_if(Gate::denies($permission_name), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }
}

function addPermission(string $permissionName): void
{
    try {
        $permissionExtensions = ['index', 'create', 'edit', 'delete'];
        foreach ($permissionExtensions as $extension) {
            $permission = new \Spatie\Permission\Models\Permission();
            $permission->name = $permissionName . ' ' . $extension;
            $permission->group_name = $permissionName;
            $permission->guard_name = 'web';
            $permission->save();
        }
    } catch (Exception $exception) {
        throw new Exception($exception->getMessage());
    }
}

if (!function_exists('item_status')) {
    function item_status($model, $id): \Illuminate\Http\RedirectResponse
    {
        $status = $model::where('id', $id)->value('status');
        if ($status == 1) {
            $model::where('id', $id)->update(['status' => 0]);
        } else {
            $model::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->back();
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

//if (!function_exists('statistic')) {
//    function statistic($name)
//    {
//        return \App\Models\Statistics::where('name', $name)->value('count');
//    }
//}

if (!function_exists('validationResponse')) {
    function validationResponse($name): string
    {
        return '<div class="valid-feedback">' . __($name) . ' ' . __('messages.is-correct') . '</div><div class="invalid-feedback">' . __($name) . ' ' . __('messages.not-correct') . '</div>';
    }
}

if (!function_exists('vacancy_tags')) {
    function vacancy_tags($tags): array|\Illuminate\Http\RedirectResponse
    {
        try {
            $tagsArray = [];
            $array = json_decode($tags);
            foreach ($array as $t) {
                $tagsArray[] = $t->value;
            }
            return $tagsArray;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('alt_category')) {
    function alt_category($id)
    {
        if ($id != null) {
            try {
                if (\App\Models\AltCategory::find($id)) {
                    return \App\Models\AltCategory::where('id', ($id))->first()->translate(app()->getLocale())->name;
                }
            } catch (Exception $e) {
                return redirect()->back();
            }
        } else {
            return 'id-is-null';
        }
    }
}

if (!function_exists('salaries')) {
    function salaries($id)
    {
        if ($id != null) {
            try {
                if (\App\Models\Salary::find($id)) {
                    return \App\Models\Salary::where('id', ($id))->first()->translate(app()->getLocale())->name;
                }
            } catch (Exception $e) {
                return redirect()->back();
            }
        } else {
            return 'id-is-null';
        }
    }
}

if (!function_exists('vacancy_time')) {
    function vacancy_time($vacancy): void
    {
        $vacancy->start_time = Carbon::now();
        $vacancy->end_time = Carbon::now()->addDay(settings('vacancy_day'));
    }
}

function convertNumber(int $value): string
{
    if ($value >= 1000 && $value < 1000000) {
        return round($value / 1000, 0) . 'k';
    }
    if ($value >= 1000000) {
        return round($value / 1000000, 0) . 'M';
    } else {
        return (string)$value;
    }
}
