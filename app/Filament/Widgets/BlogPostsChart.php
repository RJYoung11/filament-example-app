<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BlogPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'blogPostsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Product Consumed';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $products = Products::all(['product_name', 'total_item', 'item_on_hand']);

        $newValue = collect($products)->map(function ($value) {
            return [
                'consume' => $value->total_item - $value->item_on_hand,
                'product_name' => $value->product_name,
            ];
        });

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Consumed',
                    'data' => array_column($newValue->toArray(), 'consume'),
                ],
            ],
            'xaxis' => [
                'categories' => array_column($newValue->toArray(), 'product_name'),
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
            'colors' => ['#6366f1'],
        ];
    }
}
