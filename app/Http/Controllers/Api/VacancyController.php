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
    public function index()
    {
        return Vacancy::with('description')->get();
    }

    public function store(Request $request)
    {
        try {
            $vacancy = new Vacancy();
            $vacancy->causer_type = CauserEnum::COMPANY;
            $vacancy->causer_id = $request->user_id;
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
        return Vacancy::find($id);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
