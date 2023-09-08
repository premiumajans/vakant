<?php

namespace App\Services;

use App\Http\Enums\CompanyEnum;
use App\Http\Requests\Backend\Create\CompanyRequest;
use App\Models\Company;
use App\Models\PremiumCompany;
use App\Models\PremiumCompanyHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class PremiumCompanyService
{
    public function cleanUpExpiredPremiumCompanies(): void
    {
        $companies = $this->getCompaniesWithPremium();
        foreach ($companies as $company) {
            $this->handleExpiredPremium($company);
        }
    }

    private function getCompaniesWithPremium(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Company::with('premium')->get();
    }

    private function handleExpiredPremium(Company $company): void
    {
        if ($company->premium()->exists() && $this->isPremiumExpired($company)) {
            $this->deletePremium($company);
        }
    }

    private function isPremiumExpired(Company $company): bool
    {
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $company->premium->end_time);
        return $endTime->lt(Carbon::now());
    }

    public function deletePremium(Company $company): void
    {
        $company->premium()->delete();
    }

    public function makeCompanyPremium($id, int $durationInMonths, $type, $admin_id): void
    {
        try {
            $company = Company::find($id);
            $premium = new PremiumCompany();
            $premium->premium = CompanyEnum::PREMIUM;
            $premium->start_time = Carbon::now();
            $premium->end_time = Carbon::now()->addMonths($durationInMonths);
            $company->premium()->save($premium);
            $history = new PremiumCompanyHistory();
            $history->start_time = $premium->start_time;
            $history->end_time = $premium->end_time;
            $history->type = $type;
            $history->admin_id = $admin_id;
            $company->history()->save($history);
            alert()->success(__('messages.success'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
        }
    }

    public function extendPremiumTime($id, int $durationInDays): void
    {
        try {
            $company = Company::find($id);
            $premium = $company->premium;
            if ($premium) {
                $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $premium->end_time);
                $newEndTime = $endTime->copy()->addDays($durationInDays);
                $premium->end_time = $newEndTime;
                $premium->save();
                alert()->success(__('messages.success'));
            } else {
                alert()->error(__('messages.error'));
            }
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
        }
    }

    public function updateCompany($user, CompanyRequest $request)
    {
        if ($user->hasCompany()) {
            return $this->updateExistingCompany($user, $request);
        } else {
            return $this->createNewCompany($user, $request);
        }
    }

    private function updateExistingCompany($user, CompanyRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $company = $user->company()->first();
            DB::transaction(function () use ($request, $company) {
                $this->updateCompanyData($company, $request);
                $company->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }
    }

    public function createNewCompany($user, CompanyRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $company = new Company();
            $this->updateCompanyData($company, $request);
            $user->company()->save($company);
            alert()->success(__('messages.success'));
            return redirect(route('backend.site-users.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.site-users.index'));
        }
    }

    private function updateCompanyData(Company $company, CompanyRequest $request): void
    {
        $company->fill([
            'phone' => $request->phone,
            'email' => $request->email,
            'voen' => $request->voen,
            'company_type' => CompanyEnum::SIMPLE,
            'adress' => $request->address,
            'name' => $request->name,
            'about' => $request->about,
        ]);
        if ($request->hasFile('photo')) {
            if (file_exists($company->photo)) {
                unlink(public_path($company->photo));
            }
            $company->update([
                'photo' => upload('user/company', $request->file('photo'))

            ]);
        }

    }
}
