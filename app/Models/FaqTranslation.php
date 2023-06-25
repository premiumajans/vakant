<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\{LogOptions,Traits\LogsActivity};
class FaqTranslation extends Model
{
    use LogsActivity;
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['title', 'description']);
    }
}
