<x-filament-panels::page>
    <style>
        .joya-optimizer {
            margin: -24px;
            padding: 32px;
            background: #f7efe8;
            color: #000;
        }

        .joya-optimizer,
        .joya-optimizer * {
            color: #000;
        }

        .optimizer-hero {
            background: #4a2b24;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .optimizer-hero *,
        .optimizer-button {
            color: #fffaf6 !important;
        }

        .optimizer-pill {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: #ead1c8;
            color: #4a2b24 !important;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .optimizer-hero h2 {
            margin: 14px 0 8px;
            font-size: 38px;
        }

        .optimizer-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) 220px;
            gap: 14px;
            align-items: end;
            margin-top: 28px;
            background: #fffdfb;
            border-radius: 18px;
            padding: 20px;
        }

        .optimizer-form *,
        .optimizer-field label,
        .optimizer-field small {
            color: #4a2b24 !important;
        }

        .optimizer-field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .optimizer-input {
            width: 100%;
            border: 1px solid #d8c8bd;
            border-radius: 12px;
            padding: 14px 16px;
            background: #fff;
            color: #4a2b24 !important;
        }

        .optimizer-input::placeholder {
            color: #7d6259 !important;
            opacity: 1;
        }

        .optimizer-keyword {
            grid-column: span 2;
        }

        .optimizer-button {
            border: 0;
            border-radius: 12px;
            background: #a95f4c;
            padding: 15px 18px;
            font-weight: 900;
            cursor: pointer;
        }

        .optimizer-button {
            color: #fffaf6 !important;
        }

        .optimizer-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .optimizer-card,
        .optimizer-panel {
            background: #fffdfb;
            border: 1px solid #eadcd2;
            border-radius: 18px;
            box-shadow: 0 18px 50px rgba(45, 36, 32, .07);
        }

        .optimizer-card {
            padding: 22px;
        }

        .optimizer-card strong {
            display: block;
            font-size: 13px;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .optimizer-card span {
            display: block;
            margin-top: 16px;
            font-size: 38px;
            font-weight: 950;
        }

        .optimizer-card small {
            display: block;
            margin-top: 8px;
            opacity: .7;
        }

        .optimizer-score {
            background: #edf8f0;
            border-color: #77d68d;
        }

        .optimizer-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: 18px;
        }

        .optimizer-panel {
            overflow: hidden;
        }

        .optimizer-panel-header {
            padding: 22px 24px;
            border-bottom: 1px solid #eadcd2;
        }

        .optimizer-panel-header h3 {
            margin: 0 0 6px;
            font-size: 24px;
        }

        .optimizer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .optimizer-table th,
        .optimizer-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #eadcd2;
            text-align: left;
            vertical-align: top;
        }

        .optimizer-badge {
            display: inline-flex;
            border-radius: 999px;
            padding: 5px 10px;
            background: #f5dac8;
            font-weight: 900;
        }

        .optimizer-signal {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 22px;
            border-bottom: 1px solid #eadcd2;
        }

        .optimizer-signal strong {
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .optimizer-compare {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 18px;
        }

        .optimizer-terms {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 20px;
        }

        .optimizer-term {
            border-radius: 999px;
            padding: 8px 12px;
            background: #ead1c8;
            font-weight: 800;
        }

        .optimizer-history {
            margin-top: 18px;
        }

        @media (max-width: 1200px) {
            .optimizer-form,
            .optimizer-layout,
            .optimizer-compare {
                grid-template-columns: 1fr;
            }

            .optimizer-keyword {
                grid-column: span 1;
            }

            .optimizer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>

    <div class="joya-optimizer">
        <section class="optimizer-hero">
            <span class="optimizer-pill">SEO Tools</span>
            <h2>Page Optimizer</h2>
            <p>Check on-page SEO gaps and compare your article against a competitor.</p>

            <form class="optimizer-form" wire:submit="checkSeoGaps">
                <div class="optimizer-field">
                    <label for="pageUrl">Page URL</label>
                    <input id="pageUrl" class="optimizer-input" type="url" wire:model="pageUrl" placeholder="https://joyaatelier.co.ke/blog/article">
                    @error('pageUrl') <small>{{ $message }}</small> @enderror
                </div>
                <div class="optimizer-field">
                    <label for="competitorUrl">Competitor URL</label>
                    <input id="competitorUrl" class="optimizer-input" type="url" wire:model="competitorUrl" placeholder="https://competitor.co.ke/article">
                    @error('competitorUrl') <small>{{ $message }}</small> @enderror
                </div>
                <button class="optimizer-button" type="submit">Check SEO Gaps</button>
                <div class="optimizer-field optimizer-keyword">
                    <label for="targetKeyword">Target keyword</label>
                    <input id="targetKeyword" class="optimizer-input" type="text" wire:model="targetKeyword" placeholder="Example: luxury flowers in Nairobi">
                    @error('targetKeyword') <small>{{ $message }}</small> @enderror
                </div>
            </form>
        </section>

        @if ($result)
            @php
                $page = $result['page'];
                $competitor = $result['competitor'];
                $gaps = $result['gaps'];
            @endphp

            <section class="optimizer-grid">
                <div class="optimizer-card optimizer-score">
                    <strong>SEO Score</strong>
                    <span>{{ $result['score'] }}</span>
                    <small>out of 100</small>
                </div>
                <div class="optimizer-card">
                    <strong>Gaps Found</strong>
                    <span>{{ count($gaps) }}</span>
                    <small>{{ $result['high_priority_count'] }} high priority</small>
                </div>
                <div class="optimizer-card">
                    <strong>Content Depth</strong>
                    <span>{{ number_format($page['word_count']) }}</span>
                    <small>visible words</small>
                </div>
                <div class="optimizer-card">
                    <strong>Fetch Time</strong>
                    <span>{{ number_format($page['fetch_ms']) }}</span>
                    <small>milliseconds</small>
                </div>
            </section>

            <section class="optimizer-layout">
                <div class="optimizer-panel">
                    <div class="optimizer-panel-header">
                        <h3>SEO Gaps</h3>
                        <p>{{ $page['url'] }}</p>
                    </div>
                    <table class="optimizer-table">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>Gap</th>
                                <th>Recommended Fix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gaps as $gap)
                                <tr>
                                    <td><span class="optimizer-badge">{{ $gap['priority'] }}</span></td>
                                    <td>{{ $gap['gap'] }}</td>
                                    <td>{{ $gap['fix'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No major gaps found. Keep improving with fresh examples and helpful internal links.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <aside class="optimizer-panel">
                    <div class="optimizer-panel-header">
                        <h3>Page Signals</h3>
                    </div>
                    <div class="optimizer-signal"><strong>Status</strong><span>{{ $page['status'] }}</span></div>
                    <div class="optimizer-signal"><strong>Title</strong><span>{{ $page['title_length'] }} chars</span></div>
                    <div class="optimizer-signal"><strong>Description</strong><span>{{ $page['description_length'] }} chars</span></div>
                    <div class="optimizer-signal"><strong>H1 / H2</strong><span>{{ count($page['h1']) }} / {{ count($page['h2']) }}</span></div>
                    <div class="optimizer-signal"><strong>Images Alt</strong><span>{{ $page['alt_coverage'] }}%</span></div>
                    <div class="optimizer-signal"><strong>Links</strong><span>{{ $page['internal_links'] }} internal, {{ $page['external_links'] }} external</span></div>
                    <div class="optimizer-signal"><strong>Keyword Uses</strong><span>{{ $page['keyword_count'] }}</span></div>
                </aside>
            </section>

            @if ($competitor)
                <section class="optimizer-compare">
                    <div class="optimizer-panel">
                        <div class="optimizer-panel-header">
                            <h3>Your Page Terms</h3>
                        </div>
                        <div class="optimizer-terms">
                            @foreach ($page['top_terms'] as $term => $count)
                                <span class="optimizer-term">{{ $term }} {{ $count }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="optimizer-panel">
                        <div class="optimizer-panel-header">
                            <h3>Competitor Terms</h3>
                            <p>{{ $competitor['url'] }}</p>
                        </div>
                        <div class="optimizer-terms">
                            @foreach ($competitor['top_terms'] as $term => $count)
                                <span class="optimizer-term">{{ $term }} {{ $count }}</span>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @endif

        <section class="optimizer-panel optimizer-history">
            <div class="optimizer-panel-header">
                <h3>Recent Checks</h3>
            </div>
            <table class="optimizer-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Page</th>
                        <th>Competitor</th>
                        <th>Score</th>
                        <th>Gaps</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->recentResults as $recent)
                        <tr>
                            <td>{{ $recent->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ Str::limit($recent->page_url, 52) }}</td>
                            <td>{{ $recent->competitor_url ? Str::limit($recent->competitor_url, 42) : 'None' }}</td>
                            <td>{{ $recent->seo_score }}/100</td>
                            <td>{{ $recent->gaps_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No page checks yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
</x-filament-panels::page>
