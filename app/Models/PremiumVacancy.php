<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PremiumVacancy extends Model
{
    protected $fillable = ['premium', 'start_time', 'end_time'];
    public $timestamps = false;
    public function vacancy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
