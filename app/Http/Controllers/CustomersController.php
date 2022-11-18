<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\Products;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $updateProduct = Products::where('id', $request->product_id)->first();
        $updateProduct->item_on_hand = (int) $updateProduct->item_on_hand - (int) $request->quantity;
        $updateProduct->save();


        $customer = $request->all();
        $newCustomer = Customers::create($customer);

        return $newCustomer;
    }

    public function checkStatus($id)
    {
        $customer = DeliveryStatus::where('customer_id', $id)->first();
        return $customer;
    }
    public function show(Customers $customers)
    {
        //
    }
    public function edit(Customers $customers)
    {
        //
    }
    public function update($id, Customers $customers)
    {
        $customerUpdate = DeliveryStatus::where('customer_id', $id)->first();

        $customerUpdate->status = 'Received';
        $customerUpdate->save();

        return $customerUpdate;
    }
    public function destroy(Customers $customers)
    {
        //
    }
}
