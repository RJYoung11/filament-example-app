<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function orders(): HasMany
    {
        return $this->hasMany(Customers::class, 'ordinary_user_id');
    }

    // public function list_orders(): BelongsTo
    // {
    //     return $this->belongsTo();
    // }
}
