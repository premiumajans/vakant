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

Route::post('/', [\App\Http\Controllers\Api\DocumentationController::class, 'index'])->name('index');
Route::group(['prefix' => '/', 'as' => 'api.', 'middleware' => 'apiMid'], function () {
    Route::resource('settings', Setting::class)->only(['index', 'show']);
});


Route::resource('salaries', Salary::class)->only(['index', 'show']);
Route::resource('education', Education::class)->only(['index', 'show']);
Route::resource('experience', Experience::class)->only(['index', 'show']);
Route::resource('categories', Category::class)->only(['index', 'show']);
Route::resource('modes', Mode::class)->only(['index', 'show']);
Route::resource('vacancies', Vacancy::class)->only(['index', 'show']);
Route::resource('city', City::class)->only(['index', 'show']);

Route::group(['prefix' => '/auth'], function () {
    Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\Api\UserController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Api\UserController::class, 'refresh']);
    Route::post('/change-password', [\App\Http\Controllers\Api\UserController::class, 'changePassword']);
});
