<?php

namespace App\Http\Enums;

use Illuminate\Validation\Rules\Enum;

class VacancyAdminEnum extends Enum
{
    const Approved = 1;
    const Pending = 0;
}
