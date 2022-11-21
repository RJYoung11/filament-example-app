<?php

namespace App\Filament\Resources\ProductCourierResource\Pages;

use App\Filament\Resources\ProductCourierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCourier extends CreateRecord
{
    protected static string $resource = ProductCourierResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
