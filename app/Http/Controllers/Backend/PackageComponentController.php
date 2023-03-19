<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Component;
use App\Models\ComponentTranslation;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PackageComponentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('packages index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponents = Component::all();
        return view('backend.packages.component.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.packages.component.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('packages create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $packageComponent = new Component();
            $packageComponent->save();
            foreach (active_langs() as $lan) {
                $translation = new ComponentTranslation();
                $translation->component_id = $packageComponent->id;
                $translation->locale = $lan->code;
                $translation->title = $request->title[$lan->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.package-components.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.package-components.index');
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponent = Component::find($id);
        return view('backend.packages.component.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('packages edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageComponent = Component::find($id);
        try {
            DB::transaction(function () use ($request, $packageComponent) {
                foreach (active_langs() as $lang) {
                    $packageComponent->translate($lang->code)->title = $request->title[$lang->code];
                }
                $packageComponent->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.componentPackages', $packageComponent->package_id));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.faq.index', $packageComponent->package_id));
        }
    }

    public function components($id)
    {
        $package = Package::find($id);
        $components = Component::all();
        $componentsID = Component::all()->pluck('id')->toArray();
        $relatedComponents = $package->component()->get();
        $rcIDs = [];
        foreach ($relatedComponents as $rc) {
            array_push($rcIDs, $rc->id);
        }
        $results = array_diff($componentsID, $rcIDs);
        return view('backend.components.index', get_defined_vars());
    }

    public function addNewComponent(Request $request)
    {
        try {
            Package::find($request->package)->component()->attach($request->component);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }

    }

    public function delete($id)
    {
        abort_if(Gate::denies('packages delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Component::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function deletePC($package, $component)
    {
        abort_if(Gate::denies('packages delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $package = Package::find($package);
            $package->component()->detach($component);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
}
