<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SalaryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $salaries = Salary::all();
        return view('backend.salaries.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('salary create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.salaries.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('salary create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $salary = new Salary();
            $salary->salary = $request->salary;
            $salary->save();
            foreach (active_langs() as $active_lang) {
                $translate = new SalaryTranslation();
                $translate->name = $request->name[$active_lang->code];
                $translate->locale = $active_lang->code;
                $translate->salary_id = $salary->id;
                $translate->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.salaries.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.salaries.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('salary edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $salary = Salary::find($id);
        return view('backend.salaries.edit', get_defined_vars());
    }

    public function update(Request $request, Salary $salary)
    {
        abort_if(Gate::denies('salary edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $salary) {
                $salary->salary = $request->salary;
                foreach (active_langs() as $lang) {
                    $salary->translate($lang->code)->name = $request->name[$lang->code];
                }
                $salary->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.salaries.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.salaries.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('salary delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Salary::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.salaries.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.salaries.index'));
        }
    }
}
