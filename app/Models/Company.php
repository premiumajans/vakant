<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function premium(): \Illuminate\Database\Eloquent\Relations\HasOne
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
