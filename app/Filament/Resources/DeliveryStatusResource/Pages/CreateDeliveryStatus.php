<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryStatusResource;
use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use App\Models\Products;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryStatus extends CreateRecord
{
    protected static string $resource = DeliveryStatusResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $buyer = Customers::where('id', $data['customer_id'])->first();
        $product = Products::where('product_name', $data['product_id'])->first();

        $data['buyer_name'] = $buyer->firstname . ' ' . $buyer->lastname;
        $data['product_id'] = $product->id;
        $data['product_name'] = $product->product_name;
        $data['status'] = "Pending";
        $data['courier_name'] = ProductCourier::where('id', $data['courier_id'])->first()->courier_name;

        $this->updateDeliverCouriers($data);

        return $data;
    }




    public function updateDeliverCouriers($data)
    {
        $courier = ProductCourier::where('id', $data['courier_id'])->first();
        $courier->to_deliver_products = json_encode([$data['buyer_name'] => $data['product_name']]);
        $courier->customer_id = $data['customer_id'];
        $courier->save();
    }
}
