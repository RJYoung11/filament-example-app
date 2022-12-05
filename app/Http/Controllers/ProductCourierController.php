<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use Illuminate\Http\Request;

class ProductCourierController extends Controller
{
    public function update($customer, $rating, ProductCourier $productCourier)
    {
        $courier = ProductCourier::where('customer_id', $customer)->first();
        DeliveryStatus::where('customer_id', $customer)->delete();

        $courier->rating = !$courier->rating ? ($courier->rating + (int) $rating) : ((int) $rating + (int)$courier->rating) / 2;

        Customers::where('id', $customer)->delete();
        $courier->save();


        return $courier;
    }
}
