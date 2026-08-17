<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('productCategory.name')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Current Price')
                    ->prefix('KSh ')
                    ->sortable(),
                TextColumn::make('previous_price')
                    ->label('Previous Price')
                    ->prefix('KSh ')
                    ->sortable(),
                TextColumn::make('discount_percent')
                    ->label('Discount')
                    ->formatStateUsing(fn (?int $state): string => $state ? "{$state}%" : 'No discount')
                    ->badge()
                    ->color(fn (?int $state): string => $state ? 'success' : 'gray'),
                IconColumn::make('is_flash_sale')
                    ->label('Flash Sale')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
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
