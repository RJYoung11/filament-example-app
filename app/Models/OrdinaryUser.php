<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrdinaryUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'fullname', 'email', 'password', 'type',
    ];

    protected $hidden = [
        'password',
    ];

    public function courier(): HasMany
    {
        return $this->hasMany(DeliveryStatus::class, 'courier_id');
    }
}
