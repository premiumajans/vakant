<?php

namespace App\Services;

use App\Http\Enums\VacancyEnum;
use App\Models\PremiumVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;

class PremiumVacancyService
{
    public function cleanUpExpiredPremiumVacancies(): void
    {
        $vacancies = $this->getVacanciesWithPremium();
        foreach ($vacancies as $vacancy) {
            $this->handleExpiredPremium($vacancy);
        }
    }

    private function getVacanciesWithPremium(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Vacancy::with('premium')->get();
    }

    private function handleExpiredPremium(Vacancy $vacancy): void
    {
        if ($vacancy->premium()->exists() && $this->isPremiumExpired($vacancy)) {
            $this->deletePremium($vacancy);
        }
    }

    public function isPremiumExpired(Vacancy $vacancy): bool
    {
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $vacancy->premium->end_time);
        return $endTime->lt(Carbon::now());
    }

    public function deletePremium(Vacancy $vacancy): void
    {
        $vacancy->premium()->delete();
    }

    public function makeVacancyPremium($id, int $durationInMonths): void
    {
        try {
            $vacancy = Vacancy::find($id);
            $premium = new PremiumVacancy();
            $premium->premium = VacancyEnum::PREMIUM;
            $premium->start_time = Carbon::now();
            $premium->end_time = Carbon::now()->addMonths($durationInMonths);
            $vacancy->premium()->save($premium);
            alert()->success(__('messages.success'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
        }
    }

    public function extendPremiumTime($id, int $durationInDays): void
    {
        try {
            $vacancy = Vacancy::find($id);
            $premium = $vacancy->premium;
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
}
