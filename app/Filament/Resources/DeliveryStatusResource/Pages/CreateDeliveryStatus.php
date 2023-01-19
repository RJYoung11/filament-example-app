<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryStatusResource;
use App\Models\Customers;
use App\Models\ProductCourier;
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
        $courier = ProductCourier::where('id', $data['courier_id'])->first();
        $courier->product_id = $data['product_id'];
        $courier->save();

        return $data;
    }
}
