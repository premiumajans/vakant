<?php

namespace App\Utils\Enums;

use Illuminate\Validation\Rules\Enum;

class CauserEnum extends Enum
{
    const SINGLE = 1; // Əgər tək səfərlik elan daxil olunubsa
    const COMPANY = 2; //Şirkət kimi qeydiyyatdan keçib paylaşılıbsa
    const ADMIN = 3; //Admin paneldən admin tərəfindən paylaşılıbsa
    const SCRAPING = 4; //Scraping tərəfindən paylaşılıbsa
}
