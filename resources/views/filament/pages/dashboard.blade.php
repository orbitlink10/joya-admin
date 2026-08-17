<x-filament-panels::page>
    <style>
        .joya-dashboard {
            margin: -24px;
            padding: 32px;
            color: #2D2420;
            background: #FAF4EE;
        }

        .joya-dash-header,
        .joya-dash-card,
        .joya-dash-panel,
        .joya-mini {
            background: #fffdfc;
            border: 1px solid #eadcd2;
            box-shadow: 0 18px 50px rgba(45, 36, 32, 0.07);
        }

        .joya-dash-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 28px;
            padding: 30px;
            border-radius: 24px;
            margin-bottom: 22px;
        }

        .joya-eyebrow {
            display: inline-flex;
            margin: 0 0 16px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #F1D7D0;
            color: #7D3C31;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
        }

        .joya-dashboard h2,
        .joya-dashboard h3 {
            margin: 0;
            color: #2D2420;
        }

        .joya-dashboard h2 {
            font-size: 34px;
            line-height: 1.1;
        }

        .joya-muted {
            margin: 10px 0 0;
            color: #756961;
            line-height: 1.7;
        }

        .joya-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .joya-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e7c9bf;
            border-radius: 999px;
            background: #fff;
            color: #7D3C31;
            padding: 12px 18px;
            font-weight: 800;
            text-decoration: none;
        }

        .joya-btn.primary {
            background: #B86B57;
            border-color: #B86B57;
            color: #fff;
        }

        .joya-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .joya-dash-card {
            position: relative;
            overflow: hidden;
            min-height: 160px;
            border-radius: 20px;
            padding: 22px;
        }

        .joya-dash-card::after {
            content: "";
            position: absolute;
            top: -42px;
            right: -42px;
            width: 118px;
            height: 118px;
            border-radius: 50%;
            background: #F1D7D0;
            opacity: 0.55;
        }

        .joya-label {
            color: #8A7A70;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .joya-number {
            margin: 28px 0 8px;
            font-size: 38px;
            font-weight: 800;
            color: #2D2420;
        }

        .joya-card-link,
        .joya-panel a {
            color: #B86B57;
            font-weight: 800;
            text-decoration: none;
        }

        .joya-grid-main {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.65fr);
            gap: 20px;
            margin-bottom: 22px;
        }

        .joya-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .joya-dash-panel {
            border-radius: 22px;
            padding: 24px;
        }

        .joya-table {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
            font-size: 14px;
        }

        .joya-table thead tr {
            background: #fff8f3;
            color: #8A7A70;
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .joya-table th,
        .joya-table td {
            padding: 13px 10px;
            border-bottom: 1px solid #f0e4dc;
            text-align: left;
        }

        .joya-table .right {
            text-align: right;
            font-weight: 800;
        }

        .joya-quick {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .joya-quick a,
        .joya-mini {
            border-radius: 14px;
            background: #fff8f3;
            border: 1px solid #eadcd2;
            padding: 14px 16px;
            color: #7D3C31;
            font-weight: 800;
            text-decoration: none;
        }

        .joya-activity {
            margin-top: 18px;
            color: #756961;
            line-height: 1.7;
        }

        .joya-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .joya-mini span {
            display: block;
            color: #756961;
            font-size: 14px;
            font-weight: 500;
        }

        .joya-mini strong {
            display: block;
            margin-top: 8px;
            color: #2D2420;
            font-size: 28px;
        }

        @media (max-width: 1200px) {
            .joya-grid-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .joya-grid-main,
            .joya-grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .joya-dashboard {
                margin: -16px;
                padding: 18px;
            }

            .joya-dash-header {
                display: grid;
            }

            .joya-grid-4,
            .joya-mini-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="joya-dashboard">
        <section class="joya-dash-header">
            <div>
                <p class="joya-eyebrow">Admin Overview</p>
                <h2>Dashboard</h2>
                <p class="joya-muted">View and manage orders, invoices, content, products, stock, and website activity from one workspace.</p>
            </div>

            <div class="joya-actions">
                <a class="joya-btn primary" href="{{ \App\Filament\Resources\Orders\OrderResource::getUrl('create') }}">+ New Order</a>
                <a class="joya-btn" href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('create') }}">Add Product</a>
                <a class="joya-btn" href="{{ \App\Filament\Resources\Articles\ArticleResource::getUrl('create') }}">Write Article</a>
            </div>
        </section>

        <section class="joya-grid-4">
            @foreach ([
                ['Orders', $this->stats['orders'], 'View orders', \App\Filament\Resources\Orders\OrderResource::getUrl()],
                ['Products', $this->stats['products'], 'Manage products', \App\Filament\Resources\Products\ProductResource::getUrl()],
                ['Articles', $this->stats['articles'], 'View articles', \App\Filament\Resources\Articles\ArticleResource::getUrl()],
                ['Stock Alerts', $this->stats['low_stock'], 'View materials', \App\Filament\Resources\Materials\MaterialResource::getUrl()],
            ] as [$label, $value, $linkLabel, $url])
                <article class="joya-dash-card">
                    <p class="joya-label">{{ $label }}</p>
                    <p class="joya-number">{{ number_format($value) }}</p>
                    <a class="joya-card-link" href="{{ $url }}">{{ $linkLabel }} -></a>
                </article>
            @endforeach
        </section>

        <section class="joya-grid-4">
            @foreach ([
                ['Total Revenue', 'KSh ' . number_format($this->stats['paid_revenue'], 2), 'Paid orders'],
                ['Pending Orders', number_format($this->stats['pending_orders']), 'Need follow-up'],
                ['Recent Orders', number_format($this->stats['recent_orders']), 'Last 7 days'],
                ['Website Views', number_format($this->stats['page_views']), 'Last 30 days'],
            ] as [$label, $value, $hint])
                <article class="joya-dash-card">
                    <p class="joya-label">{{ $label }}</p>
                    <p class="joya-number">{{ $value }}</p>
                    <p class="joya-muted">{{ $hint }}</p>
                </article>
            @endforeach
        </section>

        <section class="joya-grid-main">
            <article class="joya-dash-panel">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                    <h3>Recent Orders</h3>
                    <a href="{{ \App\Filament\Resources\Orders\OrderResource::getUrl() }}">Latest updates</a>
                </div>

                <table class="joya-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->recentOrders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td class="right">KSh {{ number_format($order->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </article>

            <article class="joya-dash-panel">
                <h3>Quick Actions</h3>
                <div class="joya-quick">
                    @foreach ([
                        ['Create order', \App\Filament\Resources\Orders\OrderResource::getUrl('create')],
                        ['Add product', \App\Filament\Resources\Products\ProductResource::getUrl('create')],
                        ['Write article', \App\Filament\Resources\Articles\ArticleResource::getUrl('create')],
                        ['Record stock movement', \App\Filament\Resources\StockMovements\StockMovementResource::getUrl('create')],
                        ['Open analytics', \App\Filament\Pages\Analytics::getUrl()],
                    ] as [$label, $url])
                        <a href="{{ $url }}">{{ $label }}</a>
                    @endforeach
                </div>
            </article>
        </section>

        <section class="joya-grid-2">
            <article class="joya-dash-panel">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                    <h3>Recent Activities</h3>
                    <span style="color: #8A7A70;">Latest updates</span>
                </div>
                <div class="joya-activity">
                    @foreach ($this->recentActivities as $activity)
                        <p>{{ $activity }}</p>
                    @endforeach
                </div>
            </article>

            <article class="joya-dash-panel">
                <h3>Business Snapshot</h3>
                <div class="joya-mini-grid">
                    <div class="joya-mini"><span>Services</span><strong>{{ number_format($this->stats['services']) }}</strong></div>
                    <div class="joya-mini"><span>Testimonials</span><strong>{{ number_format($this->stats['testimonials']) }}</strong></div>
                    <div class="joya-mini"><span>Users</span><strong>{{ number_format($this->stats['users']) }}</strong></div>
                    <div class="joya-mini"><span>WhatsApp Clicks</span><strong>{{ number_format($this->stats['whatsapp_clicks']) }}</strong></div>
                </div>
            </article>
        </section>
    </div>
</x-filament-panels::page>
