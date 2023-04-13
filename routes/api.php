<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController as City;
use App\Http\Controllers\Api\SalaryController as Salary;
use App\Http\Controllers\Api\EducationController as Education;
use App\Http\Controllers\Api\ExperienceController as Experience;
use App\Http\Controllers\Api\CategoryController as Category;
use App\Http\Controllers\Api\SettingController as Setting;
use App\Http\Controllers\Api\ModeController as Mode;
use App\Http\Controllers\Api\VacancyController as Vacancy;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'city' => City::class,
    'salaries' => Salary::class,
    'education' => Education::class,
    'experience' => Experience::class,
    'categories' => Category::class,
    'settings' => Setting::class,
    'modes' => Mode::class,
    'vacancies' => Vacancy::class,

]);

Route::group(['prefix' => '/', 'as' => 'api.', 'middleware' => 'auth:sanctum'], function () {
//    Route::apiResources([
//        'vacancies' => Vacancy::class,
//    ]);
});

Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
