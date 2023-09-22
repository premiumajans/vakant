<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\{LogOptions,Traits\LogsActivity};

class Faq extends Model implements TranslatableContract
{
    use Translatable, LogsActivity;
    public array $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['status']);
    }
}
