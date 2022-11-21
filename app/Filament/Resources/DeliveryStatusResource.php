<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryStatusResource\Pages;
use App\Filament\Resources\DeliveryStatusResource\RelationManagers;
use App\Models\Customers;
use App\Models\DeliveryStatus;
use App\Models\ProductCourier;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class DeliveryStatusResource extends Resource
{
    protected static ?string $model = DeliveryStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Delivery';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->searchable()
                    ->options(
                        Customers::select(
                            DB::raw("CONCAT(firstname,' ',lastname) AS full_name"),
                            'id'
                        )
                            ->pluck('full_name', 'id')
                    )
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->searchable()
                    ->label('Product Name')
                    ->options(function (callable $get) {
                        $products_availed = Customers::where('id', $get('customer_id'))->pluck('purchased_item', 'purchased_item');

                        return $products_availed;
                    })
                    ->required(),
                Forms\Components\Select::make('courier_id')
                    ->label('Courier Name')
                    ->searchable()
                    ->options(ProductCourier::all()->pluck('courier_name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name'),
                Tables\Columns\TextColumn::make('buyer_name'),
                Tables\Columns\TextColumn::make('courier_name'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDeliveryStatuses::route('/'),
            'create' => Pages\CreateDeliveryStatus::route('/create'),
            'edit' => Pages\EditDeliveryStatus::route('/{record}/edit'),
        ];
    }
}
