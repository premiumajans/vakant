<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Component extends Model implements TranslatableContract
{
    use Translatable, LogsActivity;

    public $translatedAttributes = ['title'];

    public function package()
    {
        return $this->belongsToMany(Package::class, 'packages_components', 'component_id', 'package_id');
    }

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
