<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Salary;
use App\Models\Mode;
use App\Models\SiteLanguage;
use App\Models\Vacancy;
use Illuminate\Support\ServiceProvider;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $countApprovedVacancies = Vacancy::where('admin_status',1)->count();
        $countPendingVacancies = Vacancy::where('admin_status',0)->count();
        $currentLanguage = SiteLanguage::where('code', app()->getLocale())->first();
        $categories = Category::all();
        $cities = City::all();
        $educations = Education::all();
        $experiences = Experience::all();
        $salaries = Salary::all();
        $modes = Mode::all();
        $menuCategories = Category::where('status', 1)->get();
        $languages = SiteLanguage::where('status', 1)->orderBy('id', 'asc')->get();
        view()->share([
            'countApprovedVacancies' => $countApprovedVacancies,
            'countPendingVacancies' => $countPendingVacancies,
            'modes' => $modes,
            'salaries' => $salaries,
            'experiences' => $experiences,
            'educations' => $educations,
            'cities' => $cities,
            'languages' => $languages,
            'currentLanguage' => $currentLanguage,
            'locale' => app()->getLocale(),
            'categories' => $categories,
            'menuCategories' => $menuCategories,
        ]);
    }
}
