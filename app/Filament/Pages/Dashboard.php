<?php

namespace App\Filament\Pages;

use App\Models\AnalyticsEvent;
use App\Models\Article;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected static ?string $title = 'Dashboard';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?int $navigationSort = -10;

    public function getStatsProperty(): array
    {
        $paidRevenue = Order::query()->where('payment_status', 'paid')->sum('total');
        $pendingOrders = Order::query()->where('status', 'pending')->count();
        $recentOrders = Order::query()->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $lowStock = Material::query()->whereColumn('quantity_on_hand', '<=', 'reorder_level')->count();

        return [
            'orders' => Order::count(),
            'pending_orders' => $pendingOrders,
            'paid_revenue' => $paidRevenue,
            'recent_orders' => $recentOrders,
            'products' => Product::count(),
            'services' => Service::count(),
            'articles' => Article::count(),
            'testimonials' => Testimonial::count(),
            'users' => User::count(),
            'page_views' => AnalyticsEvent::query()
                ->where('event_type', 'page_view')
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->count(),
            'whatsapp_clicks' => AnalyticsEvent::query()
                ->where('event_type', 'whatsapp_click')
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->count(),
            'low_stock' => $lowStock,
        ];
    }

    public function getRecentOrdersProperty()
    {
        return Order::query()
            ->latest()
            ->limit(5)
            ->get();
    }

    public function getRecentActivitiesProperty(): array
    {
        return [
            'Admin dashboard is ready for orders, content, products, and stock tracking.',
            'Analytics records page views, WhatsApp clicks, and buyer interest.',
            'Invoices and receipts can be generated from each order.',
        ];
    }
}
