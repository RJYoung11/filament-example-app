<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use App\Models\Products;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomers extends CreateRecord
{
    protected static string $resource = CustomersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $product = Products::where('id', $data['product_id'])->first();
        $data['purchased_item'] = $product->product_name;
        $product->item_on_hand = (int) $product->item_on_hand - (int) $data['quantity'];

        $product->save();

        return $data;
    }
}
