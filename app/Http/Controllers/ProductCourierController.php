<?php

namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use Illuminate\Http\Request;

class ProductCourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCourier  $productCourier
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCourier $productCourier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCourier  $productCourier
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCourier $productCourier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCourier  $productCourier
     * @return \Illuminate\Http\Response
     */
    public function update($customer, $rating, ProductCourier $productCourier)
    {
        $courier = ProductCourier::where('customer_id', $customer)->first();
        DeliveryStatus::where('customer_id', $customer)->delete();

        $courier->rating = $rating;
        $courier->save();


        return $courier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCourier  $productCourier
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCourier $productCourier)
    {
        //
    }
}
