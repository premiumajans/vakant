<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\VacancyController as GeneralVacancy;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PharIo\Version\Exception;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid', ['except' => ['show', 'index', 'show']]);
    }

    public function index()
    {
        return Vacancy::with('description')->get();
    }

    public function store(Request $request)
    {
        try {
            $user = auth('api')->authenticate();
            $vacancy = new Vacancy();
            $vacancy->causer_type = CauserEnum::COMPANY;
            $vacancy->causer_id = $user->id;
            $vacancy->admin_status = VacancyAdminEnum::Pending;
            $vacancy->shared_time = Carbon::now();
            $vacancy->end_time = Carbon::now()->addMonth();
            $vacancy->save();
            (new GeneralVacancy())->_addNewVacancy($vacancy, $request);
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'error',
            ], 500);
        }
    }

    public function show($id)
    {
        return Vacancy::find($id)->with('description')->get();
    }

    public function myItems()
    {
        $user = auth('api')->authenticate();
        $myItems = Vacancy::where('causer_id', '=', $user->id)
            ->where('causer_type', '=', 2)
            ->with('description')
            ->get();
        return response()->json([
            'item' => $myItems,
        ], 200);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        try {

        } catch (Exception $exception) {
            return response()->json([
                'message' => 'error',
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            Vacancy::find($id)->with('description')->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'vacancy-successfully-deleted',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'error',
            ], 500);
        }
    }
}
