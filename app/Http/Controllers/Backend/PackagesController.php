<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Package;
use App\Models\PackageTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackagesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('packages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packages = Package::all();
        $components = Component::all();
        return view('backend.packages.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.packages.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $package = new Package();
            $package->ads_count = $request->ads_count;
            $package->monthly_payment = $request->cost;
            $package->status = 1;
            $package->save();
            foreach (active_langs() as $lang) {
                $translation = new PackageTranslation();
                $translation->package_id = $package->id;
                $translation->locale = $lang->code;
                $translation->title = $request->title[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.packages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->route('backend.packages.index');
        }
    }


    public function edit($id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::find($id);
        return view('backend.packages.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::find($id);
        try {
            DB::transaction(function () use ($request, $package) {
                $package->ads_count = $request->ads_count;
                $package->monthly_payment = $request->cost;
                foreach (active_langs() as $lang) {
                    $package->translate($lang->code)->title = $request->title[$lang->code];
                }
                $package->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.packages.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.packages.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('packages delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Package::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.packages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->route('backend.packages.index');
        }
    }

    public function packageStatus($id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Package::where('id', $id)->value('status');
        if ($status == 1) {
            Package::where('id', $id)->update(['status' => 0]);
        } else {
            Package::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.packages.index');
    }
}
