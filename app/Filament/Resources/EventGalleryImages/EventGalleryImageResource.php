<?php

namespace App\Filament\Resources\EventGalleryImages;

use App\Filament\Resources\EventGalleryImages\Pages\CreateEventGalleryImage;
use App\Filament\Resources\EventGalleryImages\Pages\EditEventGalleryImage;
use App\Filament\Resources\EventGalleryImages\Pages\ListEventGalleryImages;
use App\Filament\Resources\EventGalleryImages\Schemas\EventGalleryImageForm;
use App\Filament\Resources\EventGalleryImages\Tables\EventGalleryImagesTable;
use App\Models\EventGalleryImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EventGalleryImageResource extends Resource
{
    protected static ?string $model = EventGalleryImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Event Gallery';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return EventGalleryImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventGalleryImagesTable::configure($table);
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
            'index' => ListEventGalleryImages::route('/'),
            'create' => CreateEventGalleryImage::route('/create'),
            'edit' => EditEventGalleryImage::route('/{record}/edit'),
        ];
    }
}
