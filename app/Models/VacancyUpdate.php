<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyUpdate extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
