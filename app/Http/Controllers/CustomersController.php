<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\Products;
use App\Notifications\CustomerAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $customer['purchased_item'] = $updateProduct->product_name;
        $newCustomer = Customers::create($customer);

        (new CustomerAdded($newCustomer));
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
    public function update($id, $rate, Customers $customers)
    {
        $customerUpdate = DeliveryStatus::where('customer_id', $id)->delete();

        return $customerUpdate;
    }
    public function destroy(Customers $customers)
    {
        //
    }
}
