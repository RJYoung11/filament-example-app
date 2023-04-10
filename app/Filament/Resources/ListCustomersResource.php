<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListCustomersResource\Pages;
use App\Filament\Resources\ListCustomersResource\RelationManagers\ListOrdersRelationManager;
use App\Models\OrdinaryUser;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListCustomersResource extends Resource
{
    protected static ?string $model = OrdinaryUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $slug = 'list-customers';

    protected static ?string $navigationLabel = 'List of Customers';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withCount('orders')->where('type', 'customer');
        // return static::getModel()::query()->withCount('to_deliver_product');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullname')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\TextInput::make('password')->required(),
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
                Tables\Columns\TextColumn::make('orders_count')
                    ->label('Total Orders'),
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
            ListOrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListCustomers::route('/'),
            'create' => Pages\CreateListCustomers::route('/create'),
            'edit' => Pages\EditListCustomers::route('/{record}/edit'),
        ];
    }
}
