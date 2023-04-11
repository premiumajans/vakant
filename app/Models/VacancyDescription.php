<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyDescription extends Model
{
    public $timestamps = false;

    public $guarded = [];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
