<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function render(): View
    {
        $sampleData = Http::get('https://datausa.io/api/data?drilldowns=Nation&measures=Population');
        logger($sampleData['data']);
        return view('filament.pages.dashboard', ['data' => $sampleData['data']])
            ->layout(static::$layout, $this->getLayoutData());
    }
}
