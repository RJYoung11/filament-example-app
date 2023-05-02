<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCourierResource\Pages;
use App\Filament\Resources\ToDeliverProductsResource\RelationManagers\ToDeliverProductsRelationManager;
use App\Models\OrdinaryUser;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ProductCourierResource extends Resource
{
    protected static ?string $model = OrdinaryUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Delivery Couriers';

    protected static ?string $navigationGroup = 'Delivery';

    protected static ?string $slug = 'product-couriers';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withCount('courier')->where('type', 'courier');
        // return static::getModel()::query()->withCount('to_deliver_product');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullname')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\TextInput::make('password')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'customer' => 'Customer',
                        'courier' => 'Courier',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('courier_count')->label("Item's to deliver"),
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
            ToDeliverProductsRelationManager::class,
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
