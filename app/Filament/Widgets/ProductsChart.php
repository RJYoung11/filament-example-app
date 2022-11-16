<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class ProductsChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Products created',
                    'data' => [10, 10, 51, 2, 21, 32, 31, 74, 65, 45, 56, 23],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
