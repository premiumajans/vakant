<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\AltcategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Contact;
use App\Models\Education;
use App\Models\EducationTranslation;
use App\Models\Paylasim;
use App\Models\Salary;
use App\Models\SalaryTranslation;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function index()
    {
//        $permissions = [
//            'vacancies index',
//            'vacancies create',
//            'vacancies edit',
//            'vacancies delete',
//        ];
//        foreach ($permissions as $p) {
//            $pp = new Permission();
//            $pp->name = $p;
//            $pp->guard_name = 'web';
//            $pp->save();
//        }
        $counts = [
//            'newsViews' => convert_number(Paylasim::where('category_id', Category::where('slug', 'news')->value('id'))->get()->sum('view_count')),
//            'allViews' => convert_number(Paylasim::where('category_id', '!=', Category::where('slug', 'news')->value('id'))->get()->sum('view_count')),
//            'generalViews' => convert_number(Paylasim::all()->sum('view_count')),
//            'news' => convert_number(Paylasim::where('category_id', Category::where('slug', 'news')->value('id'))->count()),
//            'contactUs' => convert_number(Contact::count()),
//            'posts' => convert_number(Paylasim::where('category_id', '!=', Category::where('slug', 'news')->value('id'))->count()),
//            'sliderCount' => convert_number(Slider::count()),
//            'sharedPostCount' => convert_number(Paylasim::where('user_id', Auth::user()->id)->count()),
        ];
        return view('backend.dashboard', get_defined_vars());
    }
}
