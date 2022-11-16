<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryStatusResource;
use App\Models\Customers;
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
        logger($data);
        return $data;
    }
}
