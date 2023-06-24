<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Http\Enums\PremiumEnum;
use App\Models\Admin;
use App\Models\Company;
use App\Models\PremiumCompany;
use App\Models\PremiumCompanyHistory;
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
        $this->middleware('apiMid');
        $this->user = auth('api')->authenticate();
        $this->companyService = $companyService;
    }

    public function index()
    {
        if (Admin::find($this->user->id)->company()->exists()) {
            $company = Admin::find($this->user->id)->company()->with('premium')->first();
            $premium = $company->premium()->exists();
            return response()->json([
                'status' => 'success',
                'premium' => $premium,
                'message' => $company,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'company-not-found',
            ], 404);
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
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $companyUser = Admin::find($this->user->id);
        if ($companyUser->company()->exists()) {
            $company = Company::find($companyUser->company()->first()->id);
            $company->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'adress' => $request->address,
                'about' => $request->about,
            ]);
            return response()->json([
                'status' => 'success',
                'company' => $company,
                'message' => 'company-successfully-updated',
            ], 200);
        } else {
            $company = new Company();
            $company->name = $request->name;
            $company->phone = $request->phone;
            $company->email = $request->email;
            $company->about = $request->about;
            $company->company_type = CompanyEnum::SIMPLE;
            $company->adress = $request->address;
            $companyUser->company()->save($company);
            return response()->json([
                'status' => 'success',
                'company' => $company,
                'message' => 'company-successfully-stored',
            ], 200);
        }
    }

    public function changeType()
    {
        $companyUser = Admin::find($this->user->id);
        $company = Company::find($companyUser->company()->first()->id);
        if ($company->company_type != CompanyEnum::PREMIUM) {
            $company->update([
                'company_type' => CompanyEnum::PREMIUM,
            ]);
            return response()->json([
                'message' => 'company-successfully-premium',
            ], 200);
        } else {
            return response()->json([
                'message' => 'company-already-premium',
            ], 200);
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'photo' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }
            $company = Admin::find($this->user->id)->company()->first();
            $company->update([
                'photo' => api_upload('users/companies', $request->file('photo'))
            ]);
            return response()->json([
                'message' => 'profile-photo-successfully-updated',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    public function premium($id)
    {
//        $this->companyService->makeCompanyPremium($id, 1, PremiumEnum::DASHBOARD, $this->user->id);
//        return response()->json(['company' => Company::where('id', $id)->with('premium')->first()]);
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
                $history->admin_id = $this->user->id;
                $company->history()->save($history);
                return response()->json(['company' => $company]);
                alert()->success(__('messages.success'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
        }
    }

    public function cancelPremium($id)
    {
        $company = Company::find($id);
        $this->companyService->deletePremium($company);
        return response()->json(['message' => 'your-premium-cancelled']);
    }

    public function extendPremium($id)
    {
        if (Company::find($id)->premium()->exists()) {
            $this->companyService->extendPremiumTime($id, 30);
            return response()->json(['message' => 'you-extend-time-1-m']);
        } else {
            return response()->json(['message' => 'your-company-not-premium']);
        }
    }
}
