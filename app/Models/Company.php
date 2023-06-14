<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
    public function premium()
    {
        return $this->hasOne(PremiumCompany::class);
    }
    public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PremiumCompanyHistory::class);
    }
    public $timestamps = false;
    protected $fillable = ['name', 'adress', 'email', 'phone', 'photo', 'about'];
}
