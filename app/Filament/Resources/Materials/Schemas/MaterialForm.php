<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->helperText('Example: Flowers, Ribbon, Wrapping, Event Decor, Tools')
                    ->maxLength(255),
                TextInput::make('unit')
                    ->helperText('Example: pcs, stems, rolls, meters, boxes')
                    ->default('pcs')
                    ->required(),
                TextInput::make('quantity_on_hand')
                    ->numeric()
                    ->default(0),
                TextInput::make('unit_cost')
                    ->numeric()
                    ->prefix('KSh')
                    ->default(0),
                TextInput::make('supplier')
                    ->maxLength(255),
                TextInput::make('reorder_level')
                    ->numeric()
                    ->default(0)
                    ->helperText('When stock reaches this level, reorder.'),
                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
