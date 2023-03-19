<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model implements TranslatableContract
{
    use LogsActivity, Translatable;

    public $translatedAttributes = ['name', 'description', 'position'];
    protected $fillable = ['photo', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo', 'status']);
    }
}
