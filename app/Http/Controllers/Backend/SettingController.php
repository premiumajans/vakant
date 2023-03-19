<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Create\SettingRequest as CreateRequest;
use App\Http\Requests\Backend\Update\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('settings index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $settings = Setting::all();
        return view('backend.settings.index', get_defined_vars());
    }

    public function edit($id)
    {
        abort_if(Gate::denies('settings edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currentSetting = Setting::find($id);
        return view('backend.settings.edit', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('settings create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.settings.create');
    }

    public function store(CreateRequest $request)
    {
        abort_if(Gate::denies('settings create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $setting = new Setting();
            $setting->name = $request->name;
            $setting->link = $request->link;
            $setting->save();
            alert()->success(__('messages.success'));
            return redirect(route('backend.settings.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.settings.index'));
        }
    }

    public function delSetting($id)
    {
        abort_if(Gate::denies('settings delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Setting::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.settings.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.settings.index'));
        }
    }

    public function update(SettingRequest $request, $id)
    {
        abort_if(Gate::denies('settings edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Setting::find($id)->update([
                'name' => $request->name,
                'link' => $request->link,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.settings.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.settings.index'));
        }
    }
}
