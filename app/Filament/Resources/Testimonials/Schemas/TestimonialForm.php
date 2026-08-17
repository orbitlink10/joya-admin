<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('occasion')
                    ->maxLength(255),
                Select::make('rating')
                    ->options([
                        1 => '1 star',
                        2 => '2 stars',
                        3 => '3 stars',
                        4 => '4 stars',
                        5 => '5 stars',
                    ])
                    ->default(5)
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
            ]);
    }
}
