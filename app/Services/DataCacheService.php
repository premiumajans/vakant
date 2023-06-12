<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\City;
use App\Models\Vacancy;
use App\Models\Education;
use App\Models\SiteLanguage;
use App\Models\Experience;
use App\Models\Mode;
use App\Models\Salary;
use App\Models\VacancyUpdate;

class DataCacheService
{
    public function getCachedCategories()
    {
        return $this->getCachedData('categories', function () {
            return Category::where('status', 1)->get();
        });
    }

    public function getCachedCities()
    {
        return $this->getCachedData('cities', function () {
            return City::all();
        });
    }

    public function getCachedCountApprovedVacancies()
    {
        return $this->getCachedData('countApprovedVacancies', function () {
            return Vacancy::where('admin_status', 1)->count();
        });
    }

    public function getCachedEducations()
    {
        return $this->getCachedData('educations', function () {
            return Education::all();
        });
    }

    public function getCachedLanguages()
    {
        return $this->getCachedData('languages', function () {
            return SiteLanguage::where('status', 1)->orderBy('id', 'asc')->get();
        });
    }

    public function getCachedExperiences()
    {
        return $this->getCachedData('experiences', function () {
            return Experience::all();
        });
    }

    public function getCachedModes()
    {
        return $this->getCachedData('modes', function () {
            return Mode::all();
        });
    }

    public function getCachedSalaries()
    {
        return $this->getCachedData('salaries', function () {
            return Salary::all();
        });
    }

    public function getCountUpdatedVacancies()
    {
        return VacancyUpdate::count();
    }

    public function getCountPendingVacancies()
    {
        return Vacancy::where('admin_status', 0)->count();
    }

    private function getCachedData($key, $callback)
    {
        if (!Cache::get($key)) {
            $data = Cache::remember($key, env('CACHE_TIME'), $callback);
        } else {
            $data = Cache::get($key);
        }

        return $data;
    }
}
