<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\VacancyController;
use App\Http\Enums\CauserEnum;
use App\Http\Enums\VacancyAdminEnum;
use App\Models\Vacancy;
use App\Models\VacancyDescription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        if (auth()->guard('admin')->user()->package()->get()->count() == 0) {
            return redirect()->route('user.packageForm');
        }
        return view('user.item.create');
    }

    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->package()->wherePivot('status', 1)->exists()) {
            alert()->error(__('messages.dont-have-package'));
            return redirect()->route('user.packageForm');
        } else {
//            try {
                $vacancy = new Vacancy();
                $vacancy->causer_type = CauserEnum::COMPANY;
                $vacancy->causer_id = auth()->guard('admin')->user()->id;
                $vacancy->admin_status = VacancyAdminEnum::Pending;
                $vacancy->shared_time = Carbon::now();
                $vacancy->save();
                (new VacancyController())->_addNewVacancy($vacancy, $request);
                $currentPackage = auth()->guard('admin')->user()->package()->where('status', 1)->first();
                $currentPackage->pivot->decrement('current_ads_count');
                if ($currentPackage->pivot->current_ads_count == 0) {
                    DB::table('admin_packages')
                        ->where('admin_id', '=', auth()->guard('admin')->user()->id)
                        ->where('package_id', '=', $currentPackage->id)
                        ->update(['status' => 0]);
                }
//                return redirect()->route('user.item.index');
//            } catch (Exception $exception) {
//                alert()->error(__('messages.error'));
//                return redirect(route('frontend.new-vacancy'));
//            }
        }
    }

    public function show($id)
    {

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
