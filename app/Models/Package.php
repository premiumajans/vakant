<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model implements TranslatableContract
{
    public function component()
    {
        return $this->belongsToMany(Component::class, 'packages_components', 'package_id', 'component_id');
    }

    public function admin()
    {
        return $this->belongsToMany(Admin::class, 'admin_packages', 'package_id', 'admin_id')->withPivot('current_ads_count', 'status', 'created_at', 'updated_at');
    }

    use Translatable, LogsActivity;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['monthly_payment', 'ads_count', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['alt_category_id', 'category_id', 'photo']);
    }
}
