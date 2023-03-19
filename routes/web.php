<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\HomeController as FHome;
use App\Http\Controllers\Frontend\AuthController as FAuth;
use App\Http\Controllers\Frontend\VacancyController as FVacancy;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;

use App\Http\Controllers\User\AuthController as UAuth;
use App\Http\Controllers\User\HomeController as UHome;
use App\Http\Controllers\User\PackageController as UPackage;
use App\Http\Controllers\User\CompanyController as UCompany;
use App\Http\Controllers\User\SecurityController as USecurity;
use App\Http\Controllers\User\AppealsController as UAppeal;
use App\Http\Controllers\User\ItemController as UItem;

Route::group(['prefix' => '/', 'as' => 'frontend.', 'middleware' => 'frontLanguage'], function () {
    Route::get('/change-language/{dil}', [LChangeLan::class, 'frontLanguage'])->name('frontLanguage');
    Route::post('/contact-us/send-message', [FHome::class, 'sendMessage'])->name('sendMessage');
    Route::get('/', [FHome::class, 'index'])->name('index');
    Route::get('contact-us', function () {
        return view('frontend.contact-us.index');
    })->name('contact-us-page');
    Route::get('/vacancies/new', [FVacancy::class, 'index'])->name('new-vacancy');
    Route::post('/vacancies/store', [FVacancy::class, 'store'])->name('storeVacancy');
    Route::get('/login', [FAuth::class, 'loginForm'])->name('loginForm');
});

Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
    Route::get('login', [UAuth::class, 'loginForm'])->name('loginForm');
    Route::get('register', [UAuth::class, 'registerForm'])->name('registerForm');
    Route::post('register', [UAuth::class, 'registerUser'])->name('registerUser');
    Route::post('login', [UAuth::class, 'loginUser'])->name('loginUser');
    Route::get('/', function () {
        return redirect()->route('user.loginForm');
    });
    Route::post('/check-user', [FVacancy::class, 'checkUser'])->name('checkUser');
    Route::post('/logout', [UAuth::class, 'logout'])->name('logout');
    Route::group(['prefix' => '/profile', 'middleware' => 'auth:admin'], function () {
        Route::get('/', [UHome::class, 'index'])->name('index');
        Route::get('/packages', [UPackage::class, 'index'])->name('packageForm');
        Route::get('/my-company', [UCompany::class, 'index'])->name('companyForm');
        Route::post('/store-my-company', [UCompany::class, 'store'])->name('storeCompany');
        Route::post('/update-user-photo', [UCompany::class, 'updatePhoto'])->name('updatePhoto');
        Route::get('/security', [USecurity::class, 'index'])->name('security');
        Route::post('/update-security/{id}', [USecurity::class, 'update'])->name('updateProfile');
        Route::get('/buy/package/{id}', [UPackage::class, 'sendForm'])->name('sendPackageForm');
        Route::post('/send-appeal', [UAppeal::class, 'index'])->name('sendAppeal');
        Route::resource('item', UItem::class);
    });
});
