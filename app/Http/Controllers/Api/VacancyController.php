<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\VacancyController as GeneralVacancy;
use App\Models\{AltCategory, Category, Company, Vacancy, VacancyUpdate};
use App\Utils\Enums\{CauserEnum};
use App\Utils\Enums\StatusEnum;
use App\Utils\Enums\VacancyAdminEnum;
use App\Utils\Enums\VacancyEnum;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['show', 'index', 'count', 'category']]);
    }

    public function index()
    {
        return Vacancy::where('end_time', '>', Carbon::now())->with('description')->orderBy('id','desc')->get();
    }

    public function category($id)
    {
        $altCategories = Category::where('id', $id)->with('alt')->first();
        $altCategoryIds = $altCategories->alt->pluck('id')->toArray();

        return response()->json([
            'vacancies' => Vacancy::where('end_time', '>', Carbon::now())
                ->whereHas('description', function ($query) use ($altCategoryIds) {
                    $query->whereIn('category_id', $altCategoryIds);
                })
                ->with('description')
                ->get()
        ], 200);
    }

    /**
     * @throws AuthenticationException
     */
    public function all()
    {
        $user = auth('api')->authenticate();
        return response()->json([
            'on_going' => Vacancy::where('end_time', '>', Carbon::now())->where('causer_id', $user->id)->where('causer_type', 2)->with('description')->get(),
            'finished' => Vacancy::where('end_time', '<', Carbon::now())->where('causer_id', $user->id)->where('causer_type', 2)->with('description')->get(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth('api')->authenticate();
            if ($user->current_ad_count != 0) {
                $company = Company::where('user_id', $user->id)->with('premium')->first();
                $vacancy = $this->createVacancy($user, $company, $request);
                (new GeneralVacancy())->_addNewVacancy($vacancy, $request);
                return response()->json([
                    'status' => 'success',
                    'message' => 'vacancy-successfully-added',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'you-dont-have-ads-count',
                ], 500);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    public function count()
    {
        $vacancies = Vacancy::with('description')->get();
        $categoryCounts = [];
        foreach ($vacancies as $vacancy) {
            if ($vacancy->description) {
                $categoryId = $vacancy->description->category_id;
                $altCategory = AltCategory::find($categoryId);
                if ($altCategory) {
                    $main = $altCategory->category()->first()->id;
                    if (!isset($categoryCounts[$main])) {
                        $categoryCounts[$main] = 1;
                    } else {
                        $categoryCounts[$main]++;
                    }
                }
            }
        }
        return response()->json($categoryCounts);
    }

    public function show($id)
    {
        if (Vacancy::where('id', $id)->where('end_time', '>', Carbon::now()) and Vacancy::where('id', $id)->exists()) {
            $vacancy = Vacancy::with(['description', 'premium'])->find($id);
            $vacancy->increment('view_count');
            return response()->json([
                'vacancy' => $vacancy,
            ], 200);
        } else {
            return response()->json([
                'vacancy' => 'vacancy-not-found',
            ], 404);
        }
    }

    public function myItems()
    {
        $user = auth('api')->authenticate();
        $myItems = $this->getMyVacancies($user);
        return response()->json([
            'item' => $myItems,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $oldVacancy = Vacancy::find($id);
            $newVacancy = $this->createVacancyUpdate($oldVacancy, $request);
            $oldVacancy->updates()->save($newVacancy);
            return response()->json([
                'status' => 'success',
                'message' => 'vacancy-successfully-updated',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'error',
            ], 500);
        }
    }

    public function deleteVacancy($id)
    {
        try {
            if (Vacancy::where('id', $id)->exists()) {
                Vacancy::find($id)->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'vacancy-successfully-deleted',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'vacancy-not-found',
                ], 404);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    private function createVacancy($user, $company, $request)
    {
        $vacancy = new Vacancy();
        $vacancy->causer_type = CauserEnum::COMPANY;
        $vacancy->causer_id = $user->id;
        $vacancy->admin_status = VacancyAdminEnum::Pending;
        if ($company->premium()->exists()) {
            $vacancy->vacancy_type = VacancyEnum::PREMIUM;
        } else {
            $vacancy->vacancy_type = VacancyEnum::SIMPLE;
        }
        $vacancy->shared_time = Carbon::now();
        $vacancy->end_time = Carbon::now()->addMonth();
        $vacancy->save();
        return $vacancy;
    }

    private function getMyVacancies($user)
    {
        return Vacancy::where('causer_id', '=', $user->id)
            ->where('causer_type', '=', 2)
            ->with('description')
            ->get();
    }

    private function createVacancyUpdate($oldVacancy, $request)
    {
        if ($oldVacancy->updates()->exists()) {
            $oldVacancy->updates()->delete();
        }
        $newVacancy = new VacancyUpdate();
        $newVacancy->vacancy_id = $oldVacancy->id;
        $newVacancy->relevant_people = $request->relevant_people;
        $newVacancy->candidate_requirement = $request->candidate_requirements;
        $newVacancy->job_description = $request->about_job;
        $newVacancy->tags = $request->tags;
        $newVacancy->company = $request->company;
        $newVacancy->email = $request->email;
        $newVacancy->phone = $request->phone;
        $newVacancy->position = $request->position;
        $newVacancy->category_id = $request->category;
        $newVacancy->max_salary = $request->maximum_salary;
        $newVacancy->min_salary = $request->minimum_salary;
        $newVacancy->max_age = $request->maximum_age;
        $newVacancy->min_age = $request->minimum_age;
        $newVacancy->city_id = $request->city;
        $newVacancy->mode_id = $request->mode;
        $newVacancy->education_id = $request->education;
        $newVacancy->experience_id = $request->experience;
        $newVacancy->shared_time = Carbon::now();
        $newVacancy->admin_status = StatusEnum::DEACTIVE;
        return $newVacancy;
    }
}
