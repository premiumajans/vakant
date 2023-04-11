<?php

namespace App\Models;

use App\Http\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;

class Admin extends Authenticatable
{
    use HasRoles,
        HasPermissions,
        HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        Notifiable,
        TwoFactorAuthenticatable;

    protected $guard = 'admin';

    public function company()
    {
        return $this->hasMany(Company::class, 'admin_id');
    }

    public function package()
    {
        return $this->belongsToMany(Package::class, 'admin_packages', 'admin_id', 'package_id')->withPivot('current_ads_count', 'status','created_at','updated_at');
    }

    public function scopeActive($query)
    {
        return $query->package()
            ->wherePivot('status',StatusEnum::ACTIVE);
    }
//    public function scopeActive($query)
//    {
//        return $query->whereHas('packages', function ($q) {
//            $q->wherePivot('status', 1);
//        });
//    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id',
        'current_ad_count',
    ];

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
}
