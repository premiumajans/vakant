<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Spatie\Activitylog\{LogOptions,Traits\LogsActivity};
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model implements TranslatableContract
{
    use Translatable, LogsActivity;
    public array $translatedAttributes = ['name'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
