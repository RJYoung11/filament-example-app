<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryStatus extends EditRecord
{
    protected static string $resource = DeliveryStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
