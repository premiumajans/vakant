<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model implements TranslatableContract
{
    use Translatable,LogsActivity;
    public $translatedAttributes = ['title','description','alt'];
    protected $fillable = ['photo','order','status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo','alt']);
    }
}
