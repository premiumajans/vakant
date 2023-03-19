<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TeamTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'position'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name', 'description', 'position']);
    }
}
