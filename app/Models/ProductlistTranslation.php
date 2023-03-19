<?php

namespace App\Models;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class ProductlistTranslation extends Model
{
    use LogsActivity;
    public $timestamps = false;
    protected $fillable = ['title', 'content'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['title', 'content']);
    }
}
