<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DeliveryStatus;
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

        logger($request);
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
    public function update(Request $request, Customers $customers)
    {
        //
    }
    public function destroy(Customers $customers)
    {
        //
    }
}
