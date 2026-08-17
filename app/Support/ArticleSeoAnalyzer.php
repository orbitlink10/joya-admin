<?php

namespace App\Support;

use Illuminate\Support\Str;

class ArticleSeoAnalyzer
{
    public static function analyze(array $article): array
    {
        $title = trim((string) ($article['title'] ?? ''));
        $slug = trim((string) ($article['slug'] ?? ''));
        $excerpt = trim((string) ($article['excerpt'] ?? ''));
        $body = trim(strip_tags((string) ($article['body'] ?? '')));
        $seoTitle = trim((string) ($article['seo_title'] ?? ''));
        $seoDescription = trim((string) ($article['seo_description'] ?? ''));
        $seoKeywords = trim((string) ($article['seo_keywords'] ?? ''));
        $featuredImage = $article['featured_image'] ?? '';
        $featuredImagePresent = is_array($featuredImage)
            ? filled(array_filter($featuredImage))
            : filled(trim((string) $featuredImage));

        $primaryKeyword = static::primaryKeyword($seoKeywords, $title);
        $combinedText = Str::lower("{$title} {$excerpt} {$body} {$seoTitle} {$seoDescription}");
        $bodyWordCount = str_word_count($body);

        $checks = [
            static::check('Keyword research', 10, filled($primaryKeyword), 'Add SEO keywords, starting with the main keyword.'),
            static::check('SEO title', 10, static::between(Str::length($seoTitle), 35, 65), 'Write an SEO title around 35-65 characters.'),
            static::check('SEO description', 10, static::between(Str::length($seoDescription), 120, 170), 'Write a clear SEO description around 120-170 characters.'),
            static::check('Useful content length', 15, $bodyWordCount >= 500, 'Write at least 500 helpful words. Stronger articles can be 800+ words.'),
            static::check('Keyword in title', 10, $primaryKeyword && Str::contains(Str::lower($title), Str::lower($primaryKeyword)), 'Use the main keyword naturally in the article title.'),
            static::check('Keyword in content', 10, $primaryKeyword && Str::contains($combinedText, Str::lower($primaryKeyword)), 'Use the main keyword naturally in the article content and SEO fields.'),
            static::check('Featured image', 10, $featuredImagePresent, 'Add a featured image for the article.'),
            static::check('Local SEO signal', 10, Str::contains($combinedText, ['kenya', 'nairobi', 'kiambu', 'thika', 'mombasa']), 'Mention your service location naturally, such as Kenya or Nairobi.'),
            static::check('Internal linking', 10, Str::contains(Str::lower((string) ($article['body'] ?? '')), ['href=', '/flowers', '/events', '/booking', '/about']), 'Add a link to another page such as Flowers, Events, Booking, or About.'),
            static::check('Ready to publish', 5, (bool) ($article['is_published'] ?? false), 'Mark the article as published when it is ready.'),
        ];

        return [
            'score' => min(100, array_sum(array_column(array_filter($checks, fn ($check) => $check['passed']), 'points'))),
            'checks' => $checks,
        ];
    }

    protected static function primaryKeyword(string $seoKeywords, string $title): string
    {
        if (filled($seoKeywords)) {
            return trim(strtok($seoKeywords, ','));
        }

        return trim($title);
    }

    protected static function between(int $value, int $min, int $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    protected static function check(string $name, int $points, bool $passed, string $recommendation): array
    {
        return compact('name', 'points', 'passed', 'recommendation');
    }
}
