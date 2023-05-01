<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function premium()
    {
        return $this->hasOne(PremiumCompany::class);
    }
    public $timestamps = false;
    protected $fillable = ['name', 'adress', 'email', 'phone', 'photo', 'about'];
}
