<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model implements TranslatableContract
{
    public function images()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    use Translatable, LogsActivity;

    public $translatedAttributes = ['title', 'content1', 'content2', 'content3'];

    protected $fillable = ['status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['title', 'content1', 'content2', 'content3']);
    }
}
