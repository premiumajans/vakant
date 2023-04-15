<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Salary;
use App\Models\Mode;
use App\Models\SiteLanguage;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }
    public function boot()
    {
        if (!Cache::get('categories')) {
            $categories = Cache::remember('categories', env('CACHE_TIME'), function () {
                return Category::where('status', 1)->get();
            });
        } else {
            $categories = Cache::get('categories');
        }
        if (!Cache::get('cities')) {
            $cities = Cache::remember('cities', env('CACHE_TIME'), function () {
                return City::all();
            });
        } else {
            $cities = Cache::get('cities');
        }
        if (!Cache::get('countApprovedVacancies')) {
            $countApprovedVacancies = Cache::remember('countApprovedVacancies', env('CACHE_TIME'), function () {
                return Vacancy::where('admin_status', 1)->count();
            });
        } else {
            $countApprovedVacancies = Cache::get('cities');
        }
        if (!Cache::get('countPendingVacancies')) {
            $countPendingVacancies = Cache::remember('countPendingVacancies', env('CACHE_TIME'), function () {
                return Vacancy::where('admin_status', 0)->count();
            });
        } else {
            $countPendingVacancies = Cache::get('countPendingVacancies');
        }
        if (!Cache::get('educations')) {
            $educations = Cache::remember('educations', env('CACHE_TIME'), function () {
                return Education::all();
            });
        } else {
            $educations = Cache::get('educations');
        }
        if (!Cache::get('languages')) {
            $languages = Cache::remember('languages', env('CACHE_TIME'), function () {
                return SiteLanguage::where('status', 1)->orderBy('id', 'asc')->get();
            });
        } else {
            $languages = Cache::get('languages');
        }
        if (!Cache::get('languages')) {
            $languages = Cache::remember('languages', env('CACHE_TIME'), function () {
                return SiteLanguage::where('status', 1)->orderBy('id', 'asc')->get();
            });
        } else {
            $languages = Cache::get('languages');
        }
        if (!Cache::get('experiences')) {
            $experiences = Cache::remember('experiences', env('CACHE_TIME'), function () {
                return Experience::all();
            });
        } else {
            $experiences = Cache::get('experiences');
        }
        if (!Cache::get('modes')) {
            $modes = Cache::remember('modes', env('CACHE_TIME'), function () {
                return Mode::all();
            });
        } else {
            $modes = Cache::get('modes');
        }
        if (!Cache::get('salaries')) {
            $salaries = Cache::remember('salaries', env('CACHE_TIME'), function () {
                return Salary::all();
            });
        } else {
            $salaries = Cache::get('salaries');
        }
        view()->share([
            'countApprovedVacancies' => $countApprovedVacancies,
            'countPendingVacancies' => $countPendingVacancies,
            'modes' => $modes,
            'salaries' => $salaries,
            'experiences' => $experiences,
            'educations' => $educations,
            'cities' => $cities,
            'languages' => $languages,
            'locale' => app()->getLocale(),
            'categories' => $categories,
        ]);
    }
}
