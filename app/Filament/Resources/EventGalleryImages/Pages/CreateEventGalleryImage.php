<?php

namespace App\Filament\Resources\EventGalleryImages\Pages;

use App\Filament\Resources\EventGalleryImages\EventGalleryImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEventGalleryImage extends CreateRecord
{
    protected static string $resource = EventGalleryImageResource::class;
}
