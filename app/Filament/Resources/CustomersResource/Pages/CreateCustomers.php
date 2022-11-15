<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use App\Models\Products;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCustomers extends CreateRecord
{
    protected static string $resource = CustomersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $product = Products::where('product_name', $data['purchased_item'])->first();
    //     $product->item_on_hand = (int) $product->item_on_hand - (int) $data['quantity'];
    //     $product->save();
    //     return $data;
    // }
}
