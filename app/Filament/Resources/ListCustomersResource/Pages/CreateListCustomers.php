<?php

namespace App\Filament\Resources\ListCustomersResource\Pages;

use App\Filament\Resources\ListCustomersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListCustomers extends CreateRecord
{
    protected static string $resource = ListCustomersResource::class;
}
