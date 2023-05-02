<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ProductsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'productsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ProductsChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $products = Products::all(['product_name', 'total_item', 'item_on_hand']);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Total Item',
                    'data' => array_column($products->toArray(), 'total_item'),
                ],
                [
                    'name' => 'Item on hand',
                    'data' => array_column($products->toArray(), 'item_on_hand'),
                ],
            ],
            'xaxis' => [
                'categories' => array_column($products->toArray(), 'product_name'),
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1', '#FF5733'],
        ];
    }
}
