<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Utils\Services\ExpiredVacancies;

class HomeController extends Controller
{
    private ExpiredVacancies $expiredVacancies;

    public function __construct(ExpiredVacancies $expiredVacancies)
    {
        $this->expiredVacancies = $expiredVacancies;
    }

    public function index()
    {
        $this->expiredVacancies->cleanUpExpiredVacancies();
        return view('backend.dashboard', get_defined_vars());
    }
}
