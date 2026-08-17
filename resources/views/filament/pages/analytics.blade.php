<x-filament-panels::page>
    <style>
        .joya-analytics {
            margin: -24px;
            padding: 32px;
            color: #2D2420;
            background: #FAF4EE;
        }

        .joya-analytics-header,
        .joya-status,
        .joya-card,
        .joya-panel,
        .joya-source {
            background: #fffdfc;
            border: 1px solid #eadcd2;
            box-shadow: 0 18px 50px rgba(45, 36, 32, 0.07);
        }

        .joya-analytics-header {
            display: flex;
            justify-content: space-between;
            gap: 28px;
            align-items: flex-end;
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

        .joya-analytics h2,
        .joya-analytics h3 {
            margin: 0;
            color: #2D2420;
        }

        .joya-analytics h2 {
            max-width: 760px;
            font-size: 34px;
            line-height: 1.1;
        }

        .joya-analytics h3 {
            font-size: 21px;
        }

        .joya-muted {
            margin: 10px 0 0;
            color: #756961;
            line-height: 1.7;
        }

        .joya-periods {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .joya-period {
            border: 1px solid #e7c9bf;
            border-radius: 999px;
            background: #fff;
            color: #7D3C31;
            padding: 10px 16px;
            font-weight: 800;
            cursor: pointer;
        }

        .joya-period.active {
            background: #B86B57;
            border-color: #B86B57;
            color: #fff;
        }

        .joya-status {
            border-radius: 22px;
            padding: 26px;
            margin-bottom: 22px;
        }

        .joya-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .joya-pill {
            border-radius: 999px;
            background: #fff8f3;
            border: 1px solid #eadcd2;
            color: #7D3C31;
            padding: 8px 13px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .joya-pill.live {
            color: #047857;
            background: #ecfdf5;
            border-color: #bbf7d0;
        }

        .joya-stat-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .joya-card {
            border-radius: 20px;
            padding: 22px;
            min-height: 150px;
        }

        .joya-label {
            color: #8A7A70;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .joya-value {
            margin: 18px 0 8px;
            color: #2D2420;
            font-size: 32px;
            font-weight: 800;
        }

        .joya-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 22px;
        }

        .joya-panel {
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
            vertical-align: top;
        }

        .joya-table th {
            text-align: left;
        }

        .joya-table .right {
            text-align: right;
            font-weight: 800;
        }

        .joya-table strong {
            color: #2D2420;
        }

        .joya-table small {
            display: block;
            color: #756961;
            margin-top: 3px;
        }

        .joya-source-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
        }

        .joya-source {
            border-radius: 16px;
            padding: 18px;
            background: #fff8f3;
        }

        .joya-source strong {
            display: block;
            overflow: hidden;
            color: #2D2420;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .joya-source span {
            display: block;
            margin-top: 8px;
            font-size: 26px;
            font-weight: 800;
        }

        @media (max-width: 1200px) {
            .joya-stat-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .joya-source-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .joya-analytics {
                margin: -16px;
                padding: 18px;
            }

            .joya-analytics-header,
            .joya-grid-2 {
                grid-template-columns: 1fr;
                display: grid;
            }

            .joya-stat-grid,
            .joya-source-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="joya-analytics">
        <section class="joya-analytics-header">
            <div>
                <p class="joya-eyebrow">Website Analytics</p>
                <h2>Track storefront traffic, product interest, and buyer actions.</h2>
                <p class="joya-muted">See which public pages attract visitors, where visits come from, what products get attention, and how that activity turns into enquiries and orders.</p>
            </div>

            <div class="joya-periods">
                @foreach ([7 => 'Last 7 days', 30 => 'Last 30 days', 90 => 'Last 90 days'] as $days => $label)
                    <button type="button" wire:click="setPeriod({{ $days }})" class="joya-period {{ $this->days === $days ? 'active' : '' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </section>

        <section class="joya-status">
            <p class="joya-label">Tracking Status</p>
            <h3>Traffic data is updating from real public visits.</h3>
            <p class="joya-muted">
                This period includes {{ number_format($this->stats['page_views']) }} page views from
                {{ number_format($this->stats['unique_visitors']) }} unique visitors across the homepage, flowers, events, booking, blog, and published content.
            </p>
            <div class="joya-pills">
                <span class="joya-pill live">Live</span>
                <span class="joya-pill">Last {{ $this->days }} days</span>
                <span class="joya-pill">{{ now()->subDays($this->days)->format('d M Y') }} to {{ now()->format('d M Y') }}</span>
            </div>
        </section>

        <section class="joya-stat-grid">
            @foreach ([
                ['Page Views', number_format($this->stats['page_views']), 'Public page visits'],
                ['Unique Visitors', number_format($this->stats['unique_visitors']), 'People counted once'],
                ['Pages / Visitor', $this->stats['pages_per_visitor'], 'Average depth'],
                ['Sessions', number_format($this->stats['sessions']), 'Visit sessions'],
                ['WhatsApp Clicks', number_format($this->stats['whatsapp_clicks']), 'Direct contact intent'],
                ['Lead Actions', number_format($this->stats['lead_actions']), 'Booking/shop actions'],
            ] as [$label, $value, $hint])
                <article class="joya-card">
                    <p class="joya-label">{{ $label }}</p>
                    <p class="joya-value">{{ $value }}</p>
                    <p class="joya-muted">{{ $hint }}</p>
                </article>
            @endforeach
        </section>

        <section class="joya-grid-2">
            <article class="joya-panel">
                <p class="joya-label">Top Pages</p>
                <h3>The pages drawing the most attention.</h3>
                <table class="joya-table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th class="right">Views</th>
                            <th class="right">Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->topPages as $page)
                            <tr>
                                <td>
                                    <strong>{{ $page->page_title ?: $page->page_path }}</strong>
                                    <small>{{ $page->page_path }}</small>
                                </td>
                                <td class="right">{{ number_format($page->views) }}</td>
                                <td class="right">{{ number_format($page->visitors) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No page views yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </article>

            <article class="joya-panel">
                <p class="joya-label">Buyer Intent</p>
                <h3>Clicks that show customer interest.</h3>
                <table class="joya-table">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Page</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->topInteractions as $interaction)
                            <tr>
                                <td>
                                    <strong>{{ str($interaction->event_type)->replace('_', ' ')->title() }}</strong>
                                    <small>{{ $interaction->label }}</small>
                                </td>
                                <td>{{ $interaction->page_path }}</td>
                                <td class="right">{{ number_format($interaction->total) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No interactions yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </article>
        </section>

        <section class="joya-panel">
            <p class="joya-label">Traffic Sources</p>
            <h3>Where visitors are coming from.</h3>
            <p class="joya-muted">Shows direct traffic, referrers, and campaign links when available.</p>

            <div class="joya-source-grid">
                @forelse ($this->trafficSources as $source)
                    <article class="joya-source">
                        <strong>{{ $source->source }}</strong>
                        <span>{{ number_format($source->total) }}</span>
                        <small>visits</small>
                    </article>
                @empty
                    <p>No traffic source data yet.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-filament-panels::page>
