<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('material_id')
                    ->label('Material')
                    ->relationship('material', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('type')
                    ->options([
                        'in' => 'Stock In - bought/received materials',
                        'out' => 'Stock Out - used materials',
                        'adjustment' => 'Adjustment - set exact stock count',
                    ])
                    ->required(),
                TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                TextInput::make('unit_cost')
                    ->numeric()
                    ->prefix('KSh')
                    ->default(0),
                TextInput::make('reference')
                    ->helperText('Leave blank to generate automatically.'),
                TextInput::make('supplier')
                    ->maxLength(255),
                DatePicker::make('movement_date')
                    ->default(now()),
                Textarea::make('notes')
                    ->helperText('Example: Bought ribbon for wedding setup, used roses for Sarah order.')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
