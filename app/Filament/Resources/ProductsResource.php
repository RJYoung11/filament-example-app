<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Models\Products;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\TemporaryUploadedFile;
use Nuhel\FilamentCropper\Components\Cropper;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('product_name')->required(),
                    Forms\Components\TextInput::make('price')
                        ->required('eur')
                        ->mask(fn (Mask $mask) => $mask->money(prefix: '$ ', thousandsSeparator: ',', decimalPlaces: 2)),
                    Forms\Components\TextInput::make('item_on_hand')->required(),
                    Forms\Components\FileUpload::make('file')->required()->preserveFilenames(),
                    // Cropper::make('file')
                    //     ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                    //         return (string) str('image_path/'.$file->hashName());
                    //     })
                    //     ->enableDownload()
                    //     ->enableOpen()
                    //     ->enableImageRotation()
                    //     ->enableImageFlipping()
                    //     ->modalSize('xs')
                    //     ->imageCropAspectRatio('16:9'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd', true)->searchable(),
                Tables\Columns\TextColumn::make('item_on_hand'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            // 'view' => Pages\ViewProducts::route('/{record}'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
