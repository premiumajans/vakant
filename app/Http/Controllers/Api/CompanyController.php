<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Http\Enums\PremiumEnum;
use App\Models\Company;
use App\Models\PremiumCompany;
use App\Models\PremiumCompanyHistory;
use App\Models\User;
use App\Utils\Services\PremiumCompanyService;
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
        $user = auth()->user();
        if (User::find($user->id)->company()->exists()) {
            $company = User::find($user->id)->company()->with('premium')->first();
            $premium = $company->premium()->exists();
            return response()->json([
                'status' => 'success',
                'premium' => $premium,
                'message' => $company,
            ]);
        } else {
            return response()->json([
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
            'adress' => 'required',
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
                'adress' => $request->adress,
                'about' => $request->about,
            ]);
            return response()->json([
                'message' => 'company-successfully-updated',
                'company' => $company
            ], 200);
        } else {
            $company = new Company();
            $company->name = $request->name;
            $company->phone = $request->phone;
            $company->email = $request->email;
            $company->about = $request->about;
            $company->company_type = CompanyEnum::SIMPLE;
            $company->adress = $request->adress;
            $companyUser->company()->save($company);
            return response()->json([
                'message' => 'company-successfully-stored',
                'company' => $company
            ], 200);
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
            return response()->json([
                'message' => 'company-successfully-set-as-premium',
                'company' => $company,
            ], 200);
        } else {
            return response()->json([
                'message' => 'company-is-already-premium',
            ], 500);
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
            return response()->json([
                'message' => 'profile-photo-successfully-updated',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
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
            return response()->json([
                'message' => 'company-successfully-premium',
                'company' => $company
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function cancelPremium($id)
    {
        $company = Company::find($id);
        $this->companyService->deletePremium($company);
        return response()->json([
            'message' => 'your-premium-subscription-has-been-cancelled',
        ], 200);
    }

    public function extendPremium($id)
    {
        if (Company::find($id)->premium()->exists()) {
            $this->companyService->extendPremiumTime($id, 30);
            return response()->json([
                'message' => 'your-premium-subscription-has-been-extended',
            ], 200);
        } else {
            return response()->json([
                'message' => 'your-company-is-not-a-premium-company',
            ], 500);
        }
    }
}
