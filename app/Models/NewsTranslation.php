<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;
    protected $fillable = ['content1', 'content2', 'content3'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['content1', 'content2', 'content3']);
    }
}
