<?php

namespace App\Filament\Resources\EventGalleryImages\Pages;

use App\Filament\Resources\EventGalleryImages\EventGalleryImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEventGalleryImage extends EditRecord
{
    protected static string $resource = EventGalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
