<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BlogPostsChart;
use App\Filament\Widgets\ProductsChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected function getWidgets(): array
    {
        return [
            StatsOverview::class,
            BlogPostsChart::class,
            ProductsChart::class,
        ];
    }
}
