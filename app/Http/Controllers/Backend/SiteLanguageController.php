<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Create\SiteLanguageRequest;
use App\Http\Requests\Backend\Update\SiteLanguageRequest as updateRequest;

use App\Models\SiteLanguage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SiteLanguageController extends Controller
{
    public function index()
    {
        checkPermission('languages index');
        $siteLanguages = SiteLanguage::all();
        return view('backend.site-languages.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('languages create');
        return view('backend.site-languages.create');
    }

    public function edit($id)
    {
        checkPermission('languages edit');
        $language = SiteLanguage::find($id);
        return view('backend.site-languages.edit', get_defined_vars());
    }

    public function store(SiteLanguageRequest $request)
    {
        checkPermission('languages create');
        try {
            $icon = upload('flags', $request->file('icon'));
            $siteLanguage = new SiteLanguage();
            $siteLanguage->name = $request->name;
            $siteLanguage->code = $request->code;
            $siteLanguage->icon = $icon;
            $siteLanguage->status = 1;
            $siteLanguage->save();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.site-languages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.site-languages.index');
        }
    }

    public function update(updateRequest $request, $id)
    {
        checkPermission('languages edit');
        try {
            if ($request->hasFile('icon')) {
                unlink(SiteLanguage::find($id)->icon);
                $icon = upload('icons', $request->file('icon'));
            }
            SiteLanguage::find($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'icon' => ($request->hasFile('icon') ? $icon : SiteLanguage::find($id)->icon),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.site-languages.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.site-languages.index');
        }
    }

    public function siteLanStatus($id)
    {
        checkPermission('languages edit');
        item_status('\App\Models\SiteLanguage',$id);
    }

    public function delSiteLang($id)
    {
        checkPermission('languages delete');
        CRUDHelper::remove_item('\App\Models\SiteLanguage', $id);
    }
}
