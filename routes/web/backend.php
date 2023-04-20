<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\HomeController as BHome;
use App\Http\Controllers\Backend\AboutController as BAbout;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController as BCategory;
use App\Http\Controllers\Backend\ContactController as BContact;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;
use App\Http\Controllers\Backend\SettingController as BSetting;
use App\Http\Controllers\Backend\SiteLanguageController as BSiteLan;
use App\Http\Controllers\Backend\AdminController as BAdmin;
use App\Http\Controllers\Backend\InformationController as BInformation;
use App\Http\Controllers\Backend\NewsletterController as BNewsletter;
use App\Http\Controllers\Backend\ReportController as BReport;
use App\Http\Controllers\Backend\SliderController as BSlider;
use App\Http\Controllers\Backend\PermissionController as BPermission;
use App\Http\Controllers\Backend\VacancyController as BVacancy;
use App\Http\Controllers\Backend\FAQController as BFaq;
use App\Http\Controllers\Backend\ProjectController as BProject;
use App\Http\Controllers\Backend\AppealsController as BAppeals;
use App\Http\Controllers\Backend\AltCategories as BAltCat;
use App\Http\Controllers\Backend\ProductController as BProduct;
use App\Http\Controllers\Backend\NewsController as BNews;
use App\Http\Controllers\Backend\ServiceController as BService;
use App\Http\Controllers\Backend\ModeController as BMode;
use App\Http\Controllers\Backend\SalaryController as BSalary;
use App\Http\Controllers\Backend\CityController as BCity;
use App\Http\Controllers\Backend\EducationController as BEducation;
use App\Http\Controllers\Backend\ExperienceController as BExperience;
use App\Http\Controllers\Backend\PackagesController as BPackage;
use App\Http\Controllers\Backend\PackageComponentController as BPackageComponent;
use App\Http\Controllers\Backend\SiteUsersController as BSiteUsers;
use App\Http\Controllers\Backend\TermController as BTerm;


Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/', [BHome::class, 'index']);
    Route::get('/change-language/{lang}', [LChangeLan::class, 'switchLang'])->name('switchLang');
    Route::get('/', [BHome::class, 'index'])->name('index');
    Route::get('/dashboard', [BHome::class, 'index'])->name('dashboard');
    Route::get('/reports', [BReport::class, 'index'])->name('report');
    Route::get('/give-permission', [BPermission::class, 'givePermission'])->name('givePermission');
    Route::get('/give-permission-to-user/{user}', [BPermission::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::get('/contact-us/{id}/read', [BContact::class, 'readContact'])->name('readContact');
    Route::post('/give-permission-to-user-update', [BPermission::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    Route::get('/packages/{id}/components', [BPackageComponent::class, 'components'])->name('componentPackages');
    Route::get('/packages/{id}/components/create', [BPackageComponent::class, 'create'])->name('createComponentPackages');
    Route::post('/packages/components/store', [BPackageComponent::class, 'store'])->name('storeComponentPackage');
    Route::post('/packages/components/{id}/update', [BPackageComponent::class, 'update'])->name('updateComponentPackage');
    Route::get('/packages/components/{id}/edit', [BPackageComponent::class, 'edit'])->name('editComponentPackages');
    Route::get('/site-users/{id}/company', [BSiteUsers::class, 'company'])->name('userCompany');
    Route::post('/site-users/{id}/company/create', [BSiteUsers::class, 'companyCreate'])->name('userCompanyCreate');
    Route::post('/package/add-new-component/', [BPackageComponent::class, 'addNewComponent'])->name('addNewComponent');
    Route::get('/vacancies/approved', [BVacancy::class, 'approved'])->name('approvedVacancies');
    Route::get('/vacancies/pending', [BVacancy::class, 'pending'])->name('pendingVacancies');
    Route::get('/vacancy/append/{id}',[BVacancy::class,'approveVacancy'])->name('approve-vacancy');


//Resources
    Route::resource('/categories', BCategory::class);
    Route::resource('/site-languages', BSiteLan::class);
    Route::resource('/contact-us', BContact::class);
    Route::resource('/settings', BSetting::class);
    Route::resource('/users', BAdmin::class);
    Route::resource('/about', BAbout::class);
    Route::resource('/information', BInformation::class);
    Route::resource('/newsletter', BNewsletter::class);
    Route::resource('/slider', BSlider::class);
    Route::resource('/permissions', BPermission::class);
    Route::resource('/faq', BFaq::class);
    Route::resource('/projects', BProject::class);
    Route::resource('/alt-categories', BAltCat::class);
    Route::resource('/products', BProduct::class);
    Route::resource('/services', BService::class);
    Route::resource('/cities', BCity::class);
    Route::resource('/salaries', BSalary::class);
    Route::resource('/education', BEducation::class);
    Route::resource('/experience', BExperience::class);
    Route::resource('/modes', BMode::class);
    Route::resource('/vacancies', BVacancy::class);
    Route::resource('/packages', BPackage::class);
    Route::resource('/site-users', BSiteUsers::class);
    Route::resource('/appeals', BAppeals::class);
    Route::resource('/term', BTerm::class);
    Route::resource('/package-components', BPackageComponent::class);

    Route::get('/slider/{id}/change-order', [BSlider::class, 'sliderOrder'])->name('sliderOrder');

//About
    Route::group(['prefix' => 'about-us', 'as' => 'about.'], function () {
        Route::resource('/news', BNews::class);
    });

//Statuses
    Route::get('/site-language/{id}/change-status', [BSiteLan::class, 'siteLanStatus'])->name('siteLanStatus');
    Route::get('/categories/{id}/change-status', [BCategory::class, 'categoryStatus'])->name('categoryStatus');
    Route::get('/settings/{id}/change-status', [BSetting::class, 'settingStatus'])->name('settingStatus');
    Route::get('/slider/{id}/change-status', [BSlider::class, 'sliderStatus'])->name('sliderStatus');
    Route::get('/faq/{id}/change-status', [BFaq::class, 'faqStatus'])->name('faqStatus');
    Route::get('/project/{id}/change-status', [BProject::class, 'projectStatus'])->name('projectStatus');
    Route::get('/alt-category/{id}/change-status', [BAltCat::class, 'altCategoryStatus'])->name('altCategoryStatus');
    Route::get('/service/{id}/change-status', [BService::class, 'serviceStatus'])->name('serviceStatus');
    Route::get('/package/{id}/change-status', [BPackage::class, 'packageStatus'])->name('packageStatus');
    Route::get('/package-component/{id}/change-status', [BPackageComponent::class, 'status'])->name('packageComponentStatus');

//Delete
    Route::get('/site-languages/{id}/delete', [BSiteLan::class, 'delSiteLang'])->name('delSiteLang');
    Route::get('/categories/{id}/delete', [BCategory::class, 'delCategory'])->name('delCategory');
    Route::get('/contact-us/{id}/delete', [BContact::class, 'delContactUS'])->name('delContactUS');
    Route::get('/settings/{id}/delete', [BSetting::class, 'delSetting'])->name('delSetting');
    Route::get('/users/{id}/delete', [BAdmin::class, 'delAdmin'])->name('delAdmin');
    Route::get('/slider/{id}/delete', [BSlider::class, 'delSlider'])->name('delSlider');
    Route::get('/report/{id}/delete', [BReport::class, 'delReport'])->name('delReport');
    Route::get('/report/clean-all', [BReport::class, 'cleanAllReport'])->name('cleanAllReport');
    Route::get('/permission/{id}/delete', [BPermission::class, 'delPermission'])->name('delPermission');
    Route::get('/newsletter/{id}/delete', [BNewsletter::class, 'delNewsletter'])->name('delNewsletter');
    Route::get('/about/vacancies/{id}/delete', [BVacancy::class, 'delVacancy'])->name('delVacancy');
    Route::get('/faq/{id}/delete', [BFaq::class, 'delFAQ'])->name('delFAQ');
    Route::get('/project/{id}/delete', [BProject::class, 'delProject'])->name('delProject');
    Route::get('/alt-categories/{id}/delete', [BAltCat::class, 'delAltCategory'])->name('delAltCategory');
    Route::get('/product/{id}/delete', [BProduct::class, 'delProduct'])->name('delProduct');
    Route::get('/news/{id}/delete', [BNews::class, 'delete'])->name('delNews');
    Route::get('/service/{id}/delete', [BService::class, 'delete'])->name('delService');
    Route::get('/appeals/{id}/delete', [BAppeals::class, 'delete'])->name('delAppeals');
    Route::get('/education/{id}/delete', [BEducation::class, 'delete'])->name('delEducation');
    Route::get('/experience/{id}/delete', [BExperience::class, 'delete'])->name('delExperience');
    Route::get('/cities/{id}/delete', [BCity::class, 'delete'])->name('delCity');
    Route::get('/salary/{id}/delete', [BSalary::class, 'delete'])->name('delSalary');
    Route::get('/mode/{id}/delete', [BMode::class, 'delete'])->name('delMode');
    Route::get('/package/{id}/delete', [BPackage::class, 'delete'])->name('delPackage');
    Route::get('/component/{id}/delete', [BPackageComponent::class, 'delete'])->name('delPackageComponent');
    Route::get('/package/{component}/component/{package}/delete', [BPackageComponent::class, 'deletePC'])->name('delPC');
    Route::get('site-users/{id}/delete', [BSiteUsers::class, 'delete'])->name('delSiteUser');

//Clear
    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        dd("Cache cleared");
    });
});
