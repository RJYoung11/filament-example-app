<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use App\Models\Customers;
use App\Models\Products;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomers extends EditRecord
{
    protected static string $resource = CustomersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $currentItemAcquire = Customers::where('firstname', '==', $data['firstname'], 'and', 'lastname', '==', $data['lastname'])->first();
        // $product = Products::where('product_name', $data['purchased_item'])->first();
        // $product->item_on_hand = (int) $product->item_on_hand - (int) $data['quantity'];
        // $product->save();
        return $data;
    }
}
