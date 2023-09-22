<?php

namespace App\Providers;

use App\Utils\Services\DataCacheService;
use App\Utils\Services\ExpiredVacancies;
use App\Utils\Services\ScarpingService;
use App\Utils\Services\VacancyScrapingService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        $this->app->singleton(DataCacheService::class, function ($app) {
            return new DataCacheService();
        });
    }

    public function boot(DataCacheService $dataCacheService): void
    {
        $premiumCompanyService = new \App\Utils\Services\PremiumCompanyService();
        $premiumCompanyService->cleanUpExpiredPremiumCompanies();
        $premiumVacancyService = new \App\Utils\Services\PremiumVacancyService();
        $premiumVacancyService->cleanUpExpiredPremiumVacancies();
        $deleteExpiredVacancies = new ExpiredVacancies();
        $deleteExpiredVacancies->cleanUpExpiredVacancies();
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
