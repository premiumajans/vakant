<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;


class AltCategory extends Model implements TranslatableContract
{
    use LogsActivity, Translatable;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public $timestamps = false;
    public $translatedAttributes = ['name'];
    protected $fillable = ['status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['status']);
    }
}
