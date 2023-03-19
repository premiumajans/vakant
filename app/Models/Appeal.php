<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    protected $guarded = [];
}
