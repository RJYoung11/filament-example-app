<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListCustomersResource\Pages;
use App\Filament\Resources\ListCustomersResource\RelationManagers\ListOrdersRelationManager;
use App\Models\OrdinaryUser;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

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
                Card::make([
                    TextInput::make('fullname')->required(),
                    PhoneInput::make('phone')->required(),
                    TextInput::make('email')->required(),
                    TextInput::make('password')->required(fn ($record) => is_null($record)),
                    Select::make('type')
                    ->options([
                        'customer' => 'Customer',
                        'courier' => 'Courier',
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('fullname'),
                TextColumn::make('email'),
                TextColumn::make('orders_count')
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
