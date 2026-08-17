<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageOptimizationResult extends Model
{
    protected $fillable = [
        'page_url',
        'competitor_url',
        'target_keyword',
        'seo_score',
        'gaps_count',
        'high_priority_count',
        'word_count',
        'competitor_word_count',
        'fetch_ms',
        'page_signals',
        'competitor_signals',
        'gaps',
    ];

    protected $casts = [
        'page_signals' => 'array',
        'competitor_signals' => 'array',
        'gaps' => 'array',
    ];
}
