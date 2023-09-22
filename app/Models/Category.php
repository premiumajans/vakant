<?php

namespace App\Models;

use App\Utils\Traits\RelationshipsTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\{LogOptions, Traits\LogsActivity};

class Category extends Model implements TranslatableContract
{
    use Translatable, LogsActivity,RelationshipsTrait;
    public function alt(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AltCategory::class, 'category_id');
    }
    public array $translatedAttributes = ['name'];
    protected $fillable = ['slug'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['slug']);
    }
}
