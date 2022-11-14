<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Filament\Resources\CustomersResource\RelationManagers;
use App\Models\Customers;
use App\Models\Products;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Services';

    public static function getEloquentQuery(): Builder
    {
        // logger(Products::all());
        collect(Customers::all())->each(function ($customer) {
            logger($customer);
        });
        return parent::getEloquentQuery()->where('firstname', '!=', 'Test');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')->required(),
                Forms\Components\TextInput::make('lastname')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\Select::make('purchased_item')->required()
                    ->label('Select an Item')
                    ->options(Products::all()->pluck('product_name', 'product_name'))
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('purchased_item')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListCustomers::route('/'),
            // 'create' => Pages\CreateCustomers::route('/create'),
            // 'view' => Pages\ViewCustomers::route('/{record}'),
            // 'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
