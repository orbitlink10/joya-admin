<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGalleryImage extends Model
{
    public const EVENT_TYPES = [
        'weddings' => 'Weddings',
        'birthdays' => 'Birthdays',
        'bridal-showers' => 'Bridal Showers',
        'baby-showers' => 'Baby Showers',
        'graduations' => 'Graduations',
        'corporate-events' => 'Corporate Events',
        'galas-dinners' => 'Galas & Dinners',
        'anniversaries' => 'Anniversaries & Intimate Gatherings',
    ];

    protected $fillable = [
        'event_type',
        'title',
        'image',
        'caption',
        'description',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getEventTypeLabelAttribute(): string
    {
        return self::EVENT_TYPES[$this->event_type] ?? $this->event_type;
    }
}
