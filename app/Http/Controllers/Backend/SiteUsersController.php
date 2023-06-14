<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Http\Enums\PremiumEnum;
use App\Http\Helpers\CRUDHelper;
use App\Models\Admin;
use App\Models\Company;
use App\Http\Requests\Backend\Create\CompanyRequest as CreateCompany;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\PremiumCompanyService;
use App\Http\Requests\Backend\Create\AdminRequest;
use Illuminate\Support\Facades\Auth;

class SiteUsersController extends Controller
{
    public function __construct(PremiumCompanyService $premiumCompanyService)
    {
        $this->premiumCompanyService = $premiumCompanyService;
    }

    public function index()
    {
        checkPermission('users index');
        $siteUsers = Admin::all();
        return view('backend.users.site.index', compact('siteUsers'));
    }

    public function create()
    {
        checkPermission('users create');
        return view('backend.users.site.create');
    }

    public function store(AdminRequest $request)
    {
        checkPermission('users create');
        try {
            $admin = new Admin();
            $admin->fill([
                'name' => $request->name,
                'email' => $request->email,
                'current_ad_count' => 1,
                'password' => Hash::make($request->password),
            ]);
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
        checkPermission('users edit');
        $admin = Admin::find($id);
        return view('backend.users.site.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        checkPermission('users edit');
        try {
            $admin = Admin::find($id);
            $admin->update([
                'name' => $request->name,
                'current_ad_count' => $request->current_ad_count,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $admin->password,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }
    }

    public function company($id)
    {
        checkPermission('users index');
        $company = Admin::find($id)->company()->first();
        return view('backend.users.site.company.index', compact('company', 'id'));
    }

    public function companyCreate(CreateCompany $request, $id)
    {
        checkPermission('users create');
        $user = Admin::find($id);
        $this->premiumCompanyService->createNewCompany($user, $request);
        return redirect()->back();
    }

    public function getPremium($id)
    {
        checkPermission('users create');
        $this->premiumCompanyService->makeCompanyPremium($id, 1, PremiumEnum::ADMIN, Auth::guard('web')->id());
        return redirect()->back();
    }

    public function getPremiumTime(Request $request, $id)
    {
        checkPermission('users create');
        $this->premiumCompanyService->extendPremiumTime($id, $request->time);
        return redirect()->back();
    }

    public function getPremiumCancel($id)
    {
        checkPermission('users create');
        $company = Company::find($id);
        if ($company) {
            $this->premiumCompanyService->deletePremium($company);
        }
        alert()->success(__('messages.success'));
        return redirect()->back();
    }

    public function delete($id)
    {
        checkPermission('users delete');
        return CRUDHelper::remove_item('\App\Models\Admin', $id);
    }
}
