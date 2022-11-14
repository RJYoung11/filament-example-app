<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomers extends ViewRecord
{
    protected static string $resource = CustomersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
