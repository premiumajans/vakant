<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            $company = Admin::find($this->user->id)->company()->get();
            return response()->json([
                'status' => 'success',
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
            'address' => 'required|different:new_password',
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
            ]);
            if ($company->translation()->exists()) {
                foreach (active_langs() as $lang) {
                    $company->translate($lang->code)->about = $request->about[$lang->code];
                    $company->save();
                }
            }
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
            $company->adress = $request->address;
            $companyUser->company()->save($company);
            foreach (active_langs() as $lang) {
                $companyTranslation = new CompanyTranslation();
                $companyTranslation->locale = $lang->code;
                $companyTranslation->company_id = $company->id;
                $companyTranslation->about = $request->about[$lang->code];
                $companyTranslation->save();
            }
            return response()->json([
                'status' => 'success',
                'company' => $company,
                'message' => 'company-successfully-stored',
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
                'photo' => upload('users/companies', $request->photo)
            ]);
            return response()->json([
                'status' => 'success',
                ''
            ], 422);
        } catch (Exception $exception) {

        }
    }
}
