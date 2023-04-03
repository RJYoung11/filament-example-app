<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Customers extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function delivery(): HasOne
    {
        return $this->hasOne(DeliveryStatus::class, 'customer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
