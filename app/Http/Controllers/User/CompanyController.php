<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $company = auth()->guard('admin')->user()->company()->first();
        return view('user.company.index', get_defined_vars());
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'unique:email|required|max:255',
                'phone' => 'required|min:6',
                'voen' => 'required',
                'address' => 'required',
            ]);
            if (!auth()->guard('admin')->user()->company()->exists()) {
                $company = new Company();
                $company->admin_id = auth()->guard('admin')->user()->id;
                $company->email = $request->email;
                $company->name = $request->name;
                $company->voen = $request->voen;
                $company->adress = $request->address;
                $company->phone = $request->phone;
                auth()->guard('admin')->user()->company()->save($company);
                foreach (active_langs() as $lang) {
                    $translation = new CompanyTranslation();
                    $translation->company_id = $company->id;
                    $translation->about = $request->about[$lang->code];
                    $translation->locale = $lang->code;
                    $translation->save();
                }
            } else {
                $userCompany = auth()->guard('admin')->user()->company()->first();
                DB::transaction(function () use ($request, $userCompany) {
                    $userCompany->email = $request->email;
                    $userCompany->name = $request->name;
                    $userCompany->adress = $request->address;
                    $userCompany->phone = $request->phone;
                    $userCompany->voen = $request->voen;
                    foreach (active_langs() as $lang) {
                        $userCompany->translate($lang->code)->about = $request->about[$lang->code];
                    }
                    $userCompany->save();
                });
            }
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error' . $e));
            return redirect()->back();
        }
    }

    public function updatePhoto(Request $request)
    {
        if (auth()->guard('admin')->user()->company()->exists()) {
            $company = auth()->guard('admin')->user()->company()->first();
            if (!$company->photo == null) {
                unlink(public_path($company->photo));
            }
            $company->update([
                'photo' => upload('user/company', $request->file('photo')),
            ]);
            return asset($company->photo);
        } else {
            abort(500);
        }
    }
}
