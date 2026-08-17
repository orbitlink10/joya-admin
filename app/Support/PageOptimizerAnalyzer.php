<?php

namespace App\Support;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class PageOptimizerAnalyzer
{
    public function compare(string $pageUrl, ?string $competitorUrl = null, ?string $targetKeyword = null): array
    {
        $page = $this->fetchAndAnalyze($pageUrl, $targetKeyword);
        $competitor = $competitorUrl ? $this->fetchAndAnalyze($competitorUrl, $targetKeyword) : null;
        $gaps = $this->buildGaps($page, $competitor, $targetKeyword);
        $score = max(0, 100 - collect($gaps)->sum(fn (array $gap): int => $gap['points']));

        return [
            'score' => $score,
            'page' => $page,
            'competitor' => $competitor,
            'gaps' => $gaps,
            'high_priority_count' => collect($gaps)->where('priority', 'High')->count(),
        ];
    }

    private function fetchAndAnalyze(string $url, ?string $targetKeyword): array
    {
        $startedAt = microtime(true);

        try {
            $response = Http::timeout(15)
                ->withHeaders(['User-Agent' => 'Joya Atelier SEO Optimizer/1.0'])
                ->get($url);

            $html = $response->body();
            $status = $response->status();
        } catch (Throwable $exception) {
            return [
                'url' => $url,
                'status' => 0,
                'fetch_ms' => (int) round((microtime(true) - $startedAt) * 1000),
                'error' => $exception->getMessage(),
                'title' => '',
                'description' => '',
                'h1' => [],
                'h2' => [],
                'word_count' => 0,
                'images' => 0,
                'images_missing_alt' => 0,
                'internal_links' => 0,
                'external_links' => 0,
                'keyword_count' => 0,
                'top_terms' => [],
            ];
        }

        $fetchMs = (int) round((microtime(true) - $startedAt) * 1000);
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html ?: '');
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);

        $title = trim((string) ($xpath->query('//title')->item(0)?->textContent ?? ''));
        $description = trim((string) ($xpath->query('//meta[translate(@name, "ABCDEFGHIJKLMNOPQRSTUVWXYZ", "abcdefghijklmnopqrstuvwxyz")="description"]/@content')->item(0)?->textContent ?? ''));
        $h1 = $this->nodeTexts($xpath, '//h1');
        $h2 = $this->nodeTexts($xpath, '//h2');
        $bodyText = trim((string) ($xpath->query('//body')->item(0)?->textContent ?? strip_tags($html)));
        $cleanText = preg_replace('/\s+/', ' ', $bodyText) ?: '';
        $words = str_word_count(Str::lower($cleanText), 1);
        $images = $xpath->query('//img');
        $links = $xpath->query('//a[@href]');
        $host = parse_url($url, PHP_URL_HOST);
        $internalLinks = 0;
        $externalLinks = 0;

        foreach ($links as $link) {
            $href = $link->attributes?->getNamedItem('href')?->textContent ?? '';
            $linkHost = parse_url($href, PHP_URL_HOST);

            if ($linkHost && $host && $linkHost !== $host) {
                $externalLinks++;
            } else {
                $internalLinks++;
            }
        }

        $missingAlt = 0;
        foreach ($images as $image) {
            $alt = trim((string) ($image->attributes?->getNamedItem('alt')?->textContent ?? ''));

            if ($alt === '') {
                $missingAlt++;
            }
        }

        $keyword = Str::lower(trim((string) $targetKeyword));

        return [
            'url' => $url,
            'status' => $status,
            'fetch_ms' => $fetchMs,
            'title' => $title,
            'title_length' => Str::length($title),
            'description' => $description,
            'description_length' => Str::length($description),
            'h1' => $h1,
            'h2' => $h2,
            'word_count' => count($words),
            'images' => $images->length,
            'images_missing_alt' => $missingAlt,
            'alt_coverage' => $images->length > 0 ? (int) round((($images->length - $missingAlt) / $images->length) * 100) : 100,
            'internal_links' => $internalLinks,
            'external_links' => $externalLinks,
            'keyword_count' => $keyword !== '' ? substr_count(Str::lower($cleanText), $keyword) : 0,
            'top_terms' => $this->topTerms($words),
        ];
    }

    private function nodeTexts(DOMXPath $xpath, string $query): array
    {
        $texts = [];

        foreach ($xpath->query($query) as $node) {
            $text = trim(preg_replace('/\s+/', ' ', $node->textContent) ?: '');

            if ($text !== '') {
                $texts[] = $text;
            }
        }

        return $texts;
    }

    private function buildGaps(array $page, ?array $competitor, ?string $targetKeyword): array
    {
        $gaps = [];

        $this->addGapIf($gaps, $page['status'] !== 200, 'High', 'Page could not be fetched successfully.', 'Check that the URL is public and returns status 200.', 18);
        $this->addGapIf($gaps, $page['title_length'] < 30 || $page['title_length'] > 60, 'Medium', "Title length is {$page['title_length']} characters.", 'Write a clear SEO title around 30-60 characters.', 8);
        $this->addGapIf($gaps, $page['description_length'] < 120 || $page['description_length'] > 160, 'Medium', "Meta description is {$page['description_length']} characters.", 'Write a persuasive description around 120-160 characters.', 8);
        $this->addGapIf($gaps, count($page['h1']) !== 1, 'High', 'Page should have exactly one H1 heading.', 'Keep one main H1 and use H2/H3 for sections.', 14);
        $this->addGapIf($gaps, count($page['h2']) < 2, 'Medium', 'Page has fewer than 2 H2 section headings.', 'Break the article into helpful sections with H2 headings.', 7);
        $this->addGapIf($gaps, $page['word_count'] < 700, 'High', "Content depth is {$page['word_count']} words.", 'Add useful details, FAQs, examples, and local Kenya context.', 15);
        $this->addGapIf($gaps, $page['alt_coverage'] < 100, 'Medium', "{$page['images_missing_alt']} images are missing alt text.", 'Describe every image with clear, natural alt text.', 8);
        $this->addGapIf($gaps, $page['internal_links'] < 3, 'Medium', "Only {$page['internal_links']} internal links found.", 'Link to related services, products, contact, and other articles.', 8);

        $keyword = trim((string) $targetKeyword);
        if ($keyword !== '') {
            $lowerKeyword = Str::lower($keyword);
            $this->addGapIf($gaps, ! str_contains(Str::lower($page['title']), $lowerKeyword), 'High', 'Target keyword is missing from the title.', 'Place the keyword naturally in the SEO title.', 12);
            $this->addGapIf($gaps, ! str_contains(Str::lower(implode(' ', $page['h1'])), $lowerKeyword), 'Medium', 'Target keyword is missing from the H1.', 'Use the keyword naturally in the main heading.', 8);
            $this->addGapIf($gaps, $page['keyword_count'] < 2, 'Medium', "Target keyword appears {$page['keyword_count']} times.", 'Use the keyword naturally in the introduction and body.', 8);
        }

        if ($competitor && empty($competitor['error'])) {
            $wordGap = ($competitor['word_count'] ?? 0) - $page['word_count'];
            $this->addGapIf($gaps, $wordGap > 300, 'High', "Competitor has about {$wordGap} more visible words.", 'Expand your article with deeper advice, examples, pricing notes, and FAQs.', 13);
            $this->addGapIf($gaps, count($competitor['h2']) > count($page['h2']) + 3, 'Medium', 'Competitor covers more subtopics with H2 headings.', 'Add missing subtopics your readers would expect.', 8);
            $this->addGapIf($gaps, $competitor['internal_links'] > $page['internal_links'] + 4, 'Low', 'Competitor uses more internal linking.', 'Add relevant links to your own pages.', 5);
        }

        return $gaps;
    }

    private function addGapIf(array &$gaps, bool $condition, string $priority, string $gap, string $fix, int $points): void
    {
        if (! $condition) {
            return;
        }

        $gaps[] = compact('priority', 'gap', 'fix', 'points');
    }

    private function topTerms(array $words): array
    {
        $stopWords = array_flip(['the', 'and', 'for', 'with', 'you', 'your', 'that', 'this', 'are', 'from', 'our', 'have', 'has', 'will', 'can', 'into', 'about', 'when', 'what', 'where', 'how', 'why', 'kwa', 'ya', 'na']);
        $terms = [];

        foreach ($words as $word) {
            if (strlen($word) < 4 || isset($stopWords[$word])) {
                continue;
            }

            $terms[$word] = ($terms[$word] ?? 0) + 1;
        }

        arsort($terms);

        return array_slice($terms, 0, 12, true);
    }
}
