<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Http\Requests\Backend\Create\CompanyRequest as CreateCompany;
use App\Models\CompanyTranslation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Backend\Create\AdminRequest;

class SiteUsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('site-users index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $siteUsers = Admin::all();
        return view('backend.users.site.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('site-users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.users.site.create');
    }

    public function store(AdminRequest $request)
    {
        abort_if(Gate::denies('site-users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('site-users edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $admin = Admin::find($id);
        return view('backend.users.site.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('site-users edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $admin = Admin::find($id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if (!(is_null($request->password))) {
                if ($request->password == $request->password_confirmation) {
                    $admin->update([
                        'password' => Hash::make($request->password),
                    ]);
                }
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }

    }

    public function company($id)
    {
        abort_if(Gate::denies('site-users index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company = Admin::find($id)->company()->first();
        return view('backend.users.site.company.index', get_defined_vars());
    }

    public function companyCreate(CreateCompany $request, $id)
    {
        abort_if(Gate::denies('site-users create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Admin::find($id);
        if ($user->company()->exists()) {
            try {
                $company = $user->company()->first();
                DB::transaction(function () use ($request, $company) {
                    $company->name = $request->name;
                    $company->phone = $request->phone;
                    $company->email = $request->email;
                    $company->adress = $request->address;
                    $company->voen = $request->voen;
                    if ($request->hasFile('photo')) {
                        $company->photo = upload('user/company', $request->file('photo'));
                    }
                    foreach (active_langs() as $lan) {
                        $company->translate($lan->code)->about = $request->about[$lan->code];
                    }
                    $company->save();
                });
                alert()->success(__('messages.success'));
                return redirect(route('backend.site-users.index'));
            } catch (Exception $e) {
                alert()->error(__('messages.error'));
                return redirect(route('backend.site-users.index'));
            }

        } else {
            try {
                $company = new Company();
                $company->phone = $request->phone;
                $company->email = $request->email;
                $company->voen = $request->voen;
                $company->adress = $request->address;
                $company->name = $request->name;
                if ($request->hasFile('photo')) {
                    $company->photo = upload('user/company', $request->file('photo'));
                }
                $user->company()->save($company);
                foreach (active_langs() as $lang) {
                    $translation = new CompanyTranslation();
                    $translation->locale = $lang->code;
                    $translation->company_id = $company->id;
                    $translation->about = $request->about[$lang->code];
                    $translation->save();
                }
                alert()->success(__('messages.success'));
                return redirect(route('backend.site-users.index'));
            } catch (Exception $e) {
                alert()->error(__('messages.error'));
                return redirect(route('backend.site-users.index'));
            }
        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('site-users delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Admin::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }
    }
}
