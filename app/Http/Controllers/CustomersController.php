<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\Products;
use App\Notifications\CustomerAdded;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        $updateProduct = Products::where('id', $request->product_id)->first();
        $updateProduct->item_on_hand = (int) $updateProduct->item_on_hand - (int) $request->quantity;
        $updateProduct->save();

        $customer = $request->all();
        $customer['purchased_item'] = $updateProduct->product_name;
        $newCustomer = Customers::create($customer);

        (new CustomerAdded($newCustomer));

        return $newCustomer;
    }

    public function store_deliver(Request $request)
    {
        $deliver = DeliveryStatus::firstOrCreate(
            ['customer_id' => $request->customer_id, 'product_id' => $request->product_id, 'courier_id' => $request->courier_id],
            ['courier_name' => $request->courier_name, 'status' => $request->status]
        );

        return $deliver;
    }

    public function checkStatus($id)
    {
        $customer = DeliveryStatus::where('customer_id', $id)->first();

        return $customer;
    }

    public function update($id, $rate, Customers $customers)
    {
        $customerUpdate = DeliveryStatus::where('customer_id', $id)->delete();

        return $customerUpdate;
    }
}
