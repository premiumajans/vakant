<?php

namespace App\Models;

use App\Http\RelationshipsTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    public function alt()
    {
        return $this->hasMany(AltCategory::class, 'category_id');
    }

    use Translatable, LogsActivity,RelationshipsTrait;

    public $translatedAttributes = ['name'];
    protected $fillable = ['slug'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['slug']);
    }
}
