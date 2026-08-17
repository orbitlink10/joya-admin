<?php

namespace App\Filament\Pages;

use App\Models\PageOptimizationResult;
use App\Support\PageOptimizerAnalyzer;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class PageOptimizer extends Page
{
    protected string $view = 'filament.pages.page-optimizer';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string|UnitEnum|null $navigationGroup = 'Business';

    protected static ?string $title = 'Page Optimizer';

    protected static ?int $navigationSort = 3;

    public string $pageUrl = '';

    public string $competitorUrl = '';

    public string $targetKeyword = '';

    public ?array $result = null;

    public function mount(): void
    {
        $this->pageUrl = url('/blog');
    }

    public function checkSeoGaps(): void
    {
        $this->validate([
            'pageUrl' => ['required', 'url'],
            'competitorUrl' => ['nullable', 'url'],
            'targetKeyword' => ['nullable', 'string', 'max:120'],
        ]);

        $this->result = app(PageOptimizerAnalyzer::class)->compare(
            $this->pageUrl,
            $this->competitorUrl ?: null,
            $this->targetKeyword ?: null,
        );

        PageOptimizationResult::create([
            'page_url' => $this->pageUrl,
            'competitor_url' => $this->competitorUrl ?: null,
            'target_keyword' => $this->targetKeyword ?: null,
            'seo_score' => $this->result['score'],
            'gaps_count' => count($this->result['gaps']),
            'high_priority_count' => $this->result['high_priority_count'],
            'word_count' => $this->result['page']['word_count'],
            'competitor_word_count' => $this->result['competitor']['word_count'] ?? null,
            'fetch_ms' => $this->result['page']['fetch_ms'],
            'page_signals' => $this->result['page'],
            'competitor_signals' => $this->result['competitor'],
            'gaps' => $this->result['gaps'],
        ]);
    }

    public function getRecentResultsProperty()
    {
        return PageOptimizationResult::query()
            ->latest()
            ->limit(5)
            ->get();
    }
}
