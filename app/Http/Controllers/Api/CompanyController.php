<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyEnum;
use App\Models\Admin;
use App\Models\Company;
use App\Models\CompanyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiMid');
        $this->user = auth('api')->authenticate();
    }

    public function index()
    {
        if (Admin::find($this->user->id)->company()->exists()) {
            $company = Admin::find($this->user->id)->company()->with('premium')->first();
            $premium = Company::find($company->id)->premium()->exists();
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
//                'photo' => $data['photo'],
              'photo' => api_upload('users/companies', $request->file('photo'))
            ]);
            return response()->json([
                'message' => 'profile-photo-successfully-updated',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'error',
            ], 500);
        }
    }
}
