<?php

namespace App\Filament\Resources\ListCustomersResource\Pages;

use App\Filament\Resources\ListCustomersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListCustomers extends ListRecords
{
    protected static string $resource = ListCustomersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
