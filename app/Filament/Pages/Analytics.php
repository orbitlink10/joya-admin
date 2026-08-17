<?php

namespace App\Filament\Pages;

use App\Models\AnalyticsEvent;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;
use UnitEnum;

class Analytics extends Page
{
    protected string $view = 'filament.pages.analytics';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|UnitEnum|null $navigationGroup = 'Business';

    public int $days = 30;

    public function setPeriod(int $days): void
    {
        $this->days = $days;
    }

    public function getStatsProperty(): array
    {
        $query = $this->periodQuery();

        $pageViews = (clone $query)->where('event_type', 'page_view')->count();
        $uniqueVisitors = (clone $query)->whereNotNull('visitor_id')->distinct('visitor_id')->count('visitor_id');
        $sessions = (clone $query)->whereNotNull('session_id')->distinct('session_id')->count('session_id');
        $productInterest = (clone $query)->where('event_type', 'product_interest')->count();
        $whatsappClicks = (clone $query)->where('event_type', 'whatsapp_click')->count();
        $leadActions = (clone $query)->where('event_type', 'lead_action')->count();

        return [
            'page_views' => $pageViews,
            'unique_visitors' => $uniqueVisitors,
            'pages_per_visitor' => $uniqueVisitors > 0 ? round($pageViews / $uniqueVisitors, 1) : 0,
            'sessions' => $sessions,
            'product_interest' => $productInterest,
            'whatsapp_clicks' => $whatsappClicks,
            'lead_actions' => $leadActions,
        ];
    }

    public function getTopPagesProperty()
    {
        return $this->periodQuery()
            ->where('event_type', 'page_view')
            ->selectRaw('page_path, page_title, count(*) as views, count(distinct visitor_id) as visitors')
            ->groupBy('page_path', 'page_title')
            ->orderByDesc('views')
            ->limit(10)
            ->get();
    }

    public function getTopInteractionsProperty()
    {
        return $this->periodQuery()
            ->whereIn('event_type', ['product_interest', 'whatsapp_click', 'lead_action'])
            ->selectRaw('event_type, label, page_path, count(*) as total')
            ->groupBy('event_type', 'label', 'page_path')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
    }

    public function getTrafficSourcesProperty()
    {
        return $this->periodQuery()
            ->where('event_type', 'page_view')
            ->selectRaw('coalesce(nullif(utm_source, ""), nullif(referrer, ""), "Direct / unknown") as source, count(*) as total')
            ->groupBy('source')
            ->orderByDesc('total')
            ->limit(8)
            ->get();
    }

    protected function periodQuery()
    {
        return AnalyticsEvent::query()
            ->where('created_at', '>=', Carbon::now()->subDays($this->days));
    }
}
