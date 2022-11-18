<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryStatusResource;
use App\Models\Customers;
use App\Models\ProductCourier;
use App\Models\Products;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryStatus extends CreateRecord
{
    protected static string $resource = DeliveryStatusResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $buyer = Customers::where('id', $data['customer_id'])->first();
        $product = Products::where('product_name', $data['product_id'])->first();

        $data['buyer_name'] = $buyer->firstname . ' ' . $buyer->lastname;
        $data['product_id'] = $product->id;
        $data['product_name'] = $product->product_name;
        $data['status'] = "Pending";

        $this->updateDeliverCouriers($data);

        return $data;
    }




    public function updateDeliverCouriers($data)
    {
        $courier = ProductCourier::where('courier_name', $data['courier_name'])->first();

        logger(print_r($courier->to_deliver_products, true));
        $courier->to_deliver_products = json_encode([$data['buyer_name'] => $data['product_name']]);
        $courier->save();
    }
}
