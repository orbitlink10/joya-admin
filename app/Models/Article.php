<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\ArticleSeoAnalyzer;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'canonical_url',
        'seo_notes',
        'seo_score',
        'seo_checks',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'seo_checks' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            if (blank($article->slug)) {
                $article->slug = static::uniqueSlug($article->title);
            }

            $analysis = ArticleSeoAnalyzer::analyze($article->attributesToArray());
            $article->seo_score = $analysis['score'];
            $article->seo_checks = $analysis['checks'];
        });
    }

    protected static function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
