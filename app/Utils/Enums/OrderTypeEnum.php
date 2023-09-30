<?php

namespace App\Utils\Enums;

use Illuminate\Validation\Rules\Enum;

class OrderTypeEnum extends Enum
{
    const PACKAGE = 1;
    const SINGLE_VIP = 2;
    const SINGLE_PREMIUM = 3;
}
