<?php

namespace App\Filament\Resources\ProductCourierResource\Pages;

use App\Filament\Resources\ProductCourierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCouriers extends ListRecords
{
    protected static string $resource = ProductCourierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
