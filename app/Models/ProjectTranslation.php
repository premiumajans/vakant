<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class ProjectTranslation extends Model
{
    protected $fillable = ['title', 'content1', 'content2', 'content3'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['title', 'content1', 'content2', 'content3']);
    }

    public $timestamps = false;
}
