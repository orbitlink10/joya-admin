<?php

namespace App\Filament\Resources\Materials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaterialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity_on_hand')
                    ->label('In Stock')
                    ->sortable(),
                TextColumn::make('unit'),
                TextColumn::make('unit_cost')
                    ->prefix('KSh ')
                    ->sortable(),
                TextColumn::make('stock_value')
                    ->label('Stock Value')
                    ->prefix('KSh '),
                TextColumn::make('reorder_level')
                    ->label('Reorder At'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
