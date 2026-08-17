<?php

namespace App\Filament\Resources\EventGalleryImages\Schemas;

use App\Models\EventGalleryImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventGalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Image')
                    ->schema([
                        Select::make('event_type')
                            ->label('Event Type')
                            ->options(EventGalleryImage::EVENT_TYPES)
                            ->required()
                            ->searchable(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->directory('event-gallery'),
                        TextInput::make('caption')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
