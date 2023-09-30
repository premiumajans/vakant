<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\Create\AdminRequest;
use App\Http\Requests\Backend\Create\CompanyRequest as CreateCompany;
use App\Models\Company;
use App\Models\User;
use App\Utils\Enums\PremiumEnum;
use App\Utils\Services\PremiumCompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiteUsersController extends Controller
{
    public function __construct(PremiumCompanyService $premiumCompanyService)
    {
        $this->premiumCompanyService = $premiumCompanyService;
    }
    public function index()
    {
        checkPermission('users index');
        $siteUsers = User::all();
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
            $admin = new User();
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
        $admin = User::find($id);
        return view('backend.users.site.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        checkPermission('users edit');
        try {
            $admin = User::find($id);
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
        $company = User::find($id)->company()->first();
        return view('backend.users.site.company.index', compact('company', 'id'));
    }

    public function companyCreate(CreateCompany $request, $id)
    {
        checkPermission('users create');
        $user = User::find($id);
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
        return CRUDHelper::remove_item('\App\Models\User', $id);
    }
}
