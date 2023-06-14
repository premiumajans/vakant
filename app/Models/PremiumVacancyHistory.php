<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumVacancyHistory extends Model
{
    protected $guarded = [];
    public function vacancy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
