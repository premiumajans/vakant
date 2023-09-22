<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumCompany extends Model
{
    protected $fillable = ['premium', 'start_time', 'end_time'];
    public $timestamps = false;
    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
