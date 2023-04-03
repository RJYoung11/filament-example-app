<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCourier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function to_deliver_product(): HasMany
    {
        return $this->hasMany(DeliveryStatus::class, 'product_id');
    }
}
