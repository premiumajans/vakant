<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Salary;
use App\Models\Mode;
use App\Models\SiteLanguage;
use App\Models\Vacancy;
use App\Models\VacancyUpdate;
use App\Services\DataCacheService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        $this->app->singleton(DataCacheService::class, function ($app) {
            return new DataCacheService();
        });
    }

    public function boot(DataCacheService $dataCacheService): void
    {
        $premiumCompanyService = new \App\Services\PremiumCompanyService();
        $premiumCompanyService->cleanUpExpiredPremiumCompanies();
        $premiumVacancyService = new \App\Services\PremiumVacancyService();
        $premiumVacancyService->cleanUpExpiredPremiumVacancies();
        $countApprovedVacancies = $dataCacheService->getCachedCountApprovedVacancies();
        $countPendingVacancies = $dataCacheService->getCountPendingVacancies();
        $countUpdatedVacancies = $dataCacheService->getCountUpdatedVacancies();
        $modes = $dataCacheService->getCachedModes();
        $salaries = $dataCacheService->getCachedSalaries();
        $experiences = $dataCacheService->getCachedExperiences();
        $educations = $dataCacheService->getCachedEducations();
        $cities = $dataCacheService->getCachedCities();
        $languages = $dataCacheService->getCachedLanguages();
        $categories = $dataCacheService->getCachedCategories();
        view()->share([
            'countApprovedVacancies' => $countApprovedVacancies,
            'countPendingVacancies' => $countPendingVacancies,
            'countUpdatedVacancies' => $countUpdatedVacancies,
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
