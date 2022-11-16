<?php

namespace App\Filament\Resources\ProductCourierResource\Pages;

use App\Filament\Resources\ProductCourierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCourier extends EditRecord
{
    protected static string $resource = ProductCourierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
