<?php

namespace App\Utils\Services;

use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;

class ExpiredVacancies
{
    public function cleanUpExpiredVacancies(): void
    {
        $vacancies = $this->getVacanciesWithExpiredEndTime();
        foreach ($vacancies as $vacancy) {
            $this->deleteExpiredVacancy($vacancy);
        }
    }

    private function getVacanciesWithExpiredEndTime(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Vacancy::where('end_time', '<', Carbon::now())->get();
    }

    private function deleteExpiredVacancy(Vacancy $vacancy): void
    {
        try {
            $vacancy->delete();
            info('Vacancy with ID ' . $vacancy->id . ' has been deleted.');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
        }
    }
}
