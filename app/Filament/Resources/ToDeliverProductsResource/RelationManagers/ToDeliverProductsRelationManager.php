<?php

namespace App\Filament\Resources\ToDeliverProductsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ToDeliverProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'to_deliver_product';

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
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('purchased_item'),
                Tables\Columns\TextColumn::make('quantity')->label('How many item/s to deliver.'),
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
