<?php

namespace App\Models;

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use LogsActivity;

    public $timestamps = false;

    public function description()
    {
        return $this->hasOne(VacancyDescription::class);
    }
    public function updates()
    {
        return $this->hasOne(VacancyUpdate::class);
    }

    public function premium()
    {
        return $this->hasOne(PremiumVacancy::class);
    }

    public function history()
    {
        return $this->hasMany(PremiumVacancyHistory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('end_time', '>=', Carbon::now()->toDateString())->get();
    }

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['age', 'email', 'phone', 'salary']);
    }
}
