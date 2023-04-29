<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public $timestamps = false;
    protected $fillable = ['name', 'adress', 'email', 'phone', 'photo', 'about'];
}
