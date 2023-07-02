<?php


namespace App\Http\Controllers;

use App\Http\Enums\CompanyEnum;
use App\Http\Enums\PremiumEnum;
use App\Models\Admin;
use App\Models\Company;
use App\Models\PremiumCompany;
use App\Models\PremiumCompanyHistory;
use App\Models\User;
use App\Services\PremiumCompanyService;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;

class CompanyController extends Controller
{
    private PremiumCompanyService $companyService;

    /**
     * @throws AuthenticationException
     */
    public function __construct(PremiumCompanyService $companyService)
    {
        $this->middleware('auth');
        $this->companyService = $companyService;
    }

    public function index()
    {
        $user = auth()->user();

        if (User::find($user->id)->company()->exists()) {
            $company = User::find($user->id)->company()->with('premium')->first();
            $premium = $company->premium()->exists();
            return view('company.index', [
                'status' => 'success',
                'premium' => $premium,
                'message' => $company,
            ]);
        } else {
            return view('company.index', [
                'status' => 'error',
                'message' => 'company-not-found',
            ]);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $companyUser = User::find(auth()->user()->id);
        if ($companyUser->company()->exists()) {
            $company = Company::find($companyUser->company()->first()->id);
            $company->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'adress' => $request->address,
                'about' => $request->about,
            ]);
            return redirect()->back()->with('success', 'Company successfully updated.');
        } else {
            $company = new Company();
            $company->name = $request->name;
            $company->phone = $request->phone;
            $company->email = $request->email;
            $company->about = $request->about;
            $company->company_type = CompanyEnum::SIMPLE;
            $company->adress = $request->address;
            $companyUser->company()->save($company);

            return redirect()->back()->with('success', 'Company successfully stored.');
        }
    }

    public function changeType()
    {
        $companyUser = User::find(auth()->user()->id);
        $company = Company::find($companyUser->company()->first()->id);
        if ($company->company_type != CompanyEnum::PREMIUM) {
            $company->update([
                'company_type' => CompanyEnum::PREMIUM,
            ]);
            return redirect()->back()->with('success', 'company-successfully-set-as-premium.');
        } else {
            return redirect()->back()->with('success', 'company-is-already-premium.');
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'photo' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            $company = User::find(auth()->user()->id)->company()->first();
            $company->update([
                'photo' => api_upload('users/companies', $request->file('photo'))
            ]);

            return redirect()->back()->with('success', 'Profile photo successfully updated.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function premium($id)
    {
        try {
            $company = Company::find($id);
            $premium = new PremiumCompany();
            $premium->premium = CompanyEnum::PREMIUM;
            $premium->start_time = Carbon::now();
            $premium->end_time = Carbon::now()->addMonths(1);
            $company->premium()->save($premium);
            $history = new PremiumCompanyHistory();
            $history->start_time = $premium->start_time;
            $history->end_time = $premium->end_time;
            $history->type = PremiumEnum::DASHBOARD;
            $history->admin_id = auth()->user()->id;
            $company->history()->save($history);

            return redirect()->back()->with('success', 'Company successfully set as premium.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to set company as premium.');
        }
    }

    public function cancelPremium($id)
    {
        $company = Company::find($id);
        $this->companyService->deletePremium($company);

        return redirect()->back()->with('success', 'Your premium subscription has been cancelled.');
    }

    public function extendPremium($id)
    {
        if (Company::find($id)->premium()->exists()) {
            $this->companyService->extendPremiumTime($id, 30);

            return redirect()->back()->with('success', 'Your premium subscription has been extended by 30 days.');
        } else {
            return redirect()->back()->with('error', 'Your company is not a premium company.');
        }
    }
}
