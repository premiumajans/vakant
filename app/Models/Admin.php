<?php

namespace App\Models;

use App\Http\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements JWTSubject
{
    use HasRoles,
        HasPermissions,
        HasApiTokens,
        HasProfilePhoto,
        Notifiable,
        TwoFactorAuthenticatable;

    protected $guarded = [];
    protected string $guard = 'admin';
    public function company(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Company::class, 'admin_id');
    }
    public function hasCompany(): bool
    {
        return $this->company()->exists();
    }
    public function package(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'admin_packages', 'admin_id', 'package_id')->withPivot('current_ads_count', 'status', 'created_at', 'updated_at');
    }
    public function scopeActive($query)
    {
        return $query->package()
            ->wherePivot('status', StatusEnum::ACTIVE);
    }
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
