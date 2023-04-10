<?php

namespace App\Filament\Resources\ListCustomersResource\RelationManagers;

use App\Models\DeliveryStatus;
use App\Models\Products;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'orders';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withoutGlobalScopes();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('list_orders'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_id')
                    ->formatStateUsing(function ($state) {
                        return Products::where('id', $state)->first()->product_name;
                    })
                    ->label('Product'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('ordinary_user_id')
                    ->formatStateUsing(function ($record) {
                        return ! is_null(DeliveryStatus::where('customer_id', $record->id)->first()) ? DeliveryStatus::where('customer_id', $record->id)->first()->status : 'Process';
                    })
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
