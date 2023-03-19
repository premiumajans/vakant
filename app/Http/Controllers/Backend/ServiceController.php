<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Productlist;
use App\Models\Service;
use App\Models\ServiceTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('services index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $services = Service::all();
        return view('backend.services.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('services create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.services.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('services create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $service = new Service();
            $service->photo = upload('services', $request->file('photo'));
            $service->status = 1;
            $service->save();
            foreach (active_langs() as $active_lang) {
                $translate = new ServiceTranslation();
                $translate->locale = $active_lang->code;
                $translate->service_id = $service->id;
                $translate->name = $request->name[$active_lang->code];
                $translate->description = $request->description[$active_lang->code];
                $translate->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('services edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::find($id);
        return view('backend.services.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('services edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = Service::find($id);
        try {
            DB::transaction(function () use ($request, $service) {
                if ($request->hasFile('photo')) {
                    unlink((public_path($service->photo)));
                    $service->photo = upload('services', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $service->translate($lang->code)->name = $request->name[$lang->code];
                    $service->translate($lang->code)->description = $request->description[$lang->code];
                }
                $service->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('services delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Service::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.services.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.services.index');
        }
    }

    public function serviceStatus($id)
    {
        abort_if(Gate::denies('services edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Service::where('id', $id)->value('status');
        if ($status == 1) {
            Service::where('id', $id)->update(['status' => 0]);
        } else {
            Service::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.services.index');
    }
}
