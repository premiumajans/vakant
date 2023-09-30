<?php

namespace App\Utils\Enums;

use Illuminate\Validation\Rules\Enum;

class StatusEnum extends Enum
{
    const DEACTIVE = 0; // Deaktiv
    const ACTIVE = 1; //Aktiv
}
