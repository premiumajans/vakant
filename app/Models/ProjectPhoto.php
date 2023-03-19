<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPhoto extends Model
{
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
