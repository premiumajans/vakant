<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\{LogOptions,Traits\LogsActivity};
class Education extends Model implements TranslatableContract
{
    use Translatable, LogsActivity;
    public array $translatedAttributes = ['name'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
