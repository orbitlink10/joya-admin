<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'event_type',
        'visitor_id',
        'session_id',
        'page_url',
        'page_path',
        'page_title',
        'label',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'ip_hash',
        'user_agent',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }
}
