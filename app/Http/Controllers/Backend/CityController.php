<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('city index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::all();
        return view('backend.city.index', get_defined_vars());

    }

    public function create()
    {
        abort_if(Gate::denies('city create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.city.create');
    }

    public function store(Request $request)
    {
        try {
            abort_if(Gate::denies('city create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $city = new City();
            $city->save();
            foreach (active_langs() as $lang) {
                $translation = new CityTranslation();
                $translation->locale = $lang->code;
                $translation->city_id = $city->id;
                $translation->name = $request->name[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.cities.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.cities.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('city edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $city = City::find($id);
        return view('backend.city.edit', get_defined_vars());
    }

    public function update(Request $request, City $city)
    {
        abort_if(Gate::denies('city edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $city) {
                foreach (active_langs() as $lang) {
                    $city->translate($lang->code)->name = $request->name[$lang->code];
                }
                $city->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.cities.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.cities.index'));
        }

    }

    public function delete($id)
    {
        try {
            City::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.cities.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.cities.index'));
        }
    }
}
