<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCourierResource\Pages;
use App\Filament\Resources\ProductCourierResource\RelationManagers;
use App\Models\ProductCourier;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCourierResource extends Resource
{
    protected static ?string $model = ProductCourier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Delivery Couriers';

    protected static ?string $navigationGroup = 'Delivery';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('courier_name')->required(),
                Forms\Components\TextInput::make('rating')->disabled(),
                Forms\Components\TextInput::make('to_deliver_products')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('courier_name'),
                Tables\Columns\TextColumn::make('rating'),
                Tables\Columns\TextColumn::make('to_deliver_products'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCouriers::route('/'),
            'create' => Pages\CreateProductCourier::route('/create'),
            'edit' => Pages\EditProductCourier::route('/{record}/edit'),
        ];
    }
}
