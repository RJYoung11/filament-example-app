<?php

namespace App\Filament\Widgets;

use App\Models\Customers;
use App\Models\OrdinaryUser;
use App\Models\Products;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $products = Products::all(['product_name', 'total_item', 'item_on_hand']);

        $newValue = collect($products)->map(function ($value) {
            return  $value->total_item - $value->item_on_hand;
        })->toArray();

        return [
            Card::make('Total Customers', Customers::count()),
            Card::make('Total Delivery Rider/Couriers', OrdinaryUser::where('type', 'courier')->count()),
            Card::make('Consumed Products', array_sum($newValue)),
        ];
    }
}
