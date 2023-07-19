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
    /**
     * @var int|mixed
     */

    public function description(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(VacancyDescription::class);
    }
    public function updates(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(VacancyUpdate::class);
    }

    public function premium(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PremiumVacancy::class);
    }

    public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
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
