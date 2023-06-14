<?php

namespace App\Http\Enums;

use Illuminate\Validation\Rules\Enum;

class PremiumEnum extends Enum
{
    const ADMIN = 1;
    const DASHBOARD = 2;
    const PERSONAL = 3;
}
