<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('product_category_id')
                    ->label('Category')
                    ->relationship('productCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(3),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
                TextInput::make('price')
                    ->label('Current Price')
                    ->numeric()
                    ->prefix('KSh'),
                TextInput::make('previous_price')
                    ->label('Previous Price')
                    ->numeric()
                    ->prefix('KSh')
                    ->helperText('Use this when a product is discounted. Example: previous 2500, current 1800.'),
                Toggle::make('is_flash_sale')
                    ->label('Flash Sale'),
                TextInput::make('sale_label')
                    ->placeholder('Flash Sale, Valentine Offer, 20% Off')
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->imageEditor(),
                Toggle::make('is_featured')
                    ->label('Featured on homepage'),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
            ]);
    }
}
