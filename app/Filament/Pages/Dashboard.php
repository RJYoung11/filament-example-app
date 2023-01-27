<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament::pages.dashboard';

}
