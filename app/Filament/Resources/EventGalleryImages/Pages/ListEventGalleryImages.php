<?php

namespace App\Filament\Resources\EventGalleryImages\Pages;

use App\Filament\Resources\EventGalleryImages\EventGalleryImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventGalleryImages extends ListRecords
{
    protected static string $resource = EventGalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
