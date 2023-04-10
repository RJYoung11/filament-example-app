<?php

namespace App\Filament\Resources\ToDeliverProductsResource\RelationManagers;

use App\Models\Customers;
use App\Models\Products;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ToDeliverProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'courier';

    protected static ?string $recordTitleAttribute = 'deliver_products';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withoutGlobalScopes();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id')
                    ->label('Customers')
                    ->formatStateUsing(function ($state) {
                        return Customers::where('id', $state)->first()->firstname.' '.Customers::where('id', $state)->first()->lastname;
                    }),
                Tables\Columns\TextColumn::make('product_id')
                    ->label('Products')
                    ->formatStateUsing(function ($state) {
                        return Products::where('id', $state)->first()->product_name;
                    }),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('product_name')
                    ->label('How many item/s to deliver.')
                    ->formatStateUsing(function ($record) {
                        logger(Customers::where('id', $record->customer_id)->first());

                        return Customers::where('id', $record->customer_id)->first()->quantity;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
