<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Spatie\Activitylog\{Traits\LogsActivity,LogOptions};
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Http\RelationshipsTrait;

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
