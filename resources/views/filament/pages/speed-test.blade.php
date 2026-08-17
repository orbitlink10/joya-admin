<x-filament-panels::page>
    <style>
        .joya-speed {
            margin: -24px;
            padding: 32px;
            background: #f7efe8;
            color: #000;
        }

        .speed-head {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .speed-pill {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: #ead1c8;
            color: #000;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .joya-speed h2,
        .joya-speed h3,
        .joya-speed p,
        .joya-speed span,
        .joya-speed button,
        .joya-speed a,
        .joya-speed td,
        .joya-speed th {
            color: #000;
        }

        .joya-speed h2 {
            margin: 14px 0 8px;
            font-size: 38px;
            line-height: 1.05;
        }

        .speed-muted {
            margin: 0;
            color: #000;
            opacity: .72;
        }

        .speed-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .speed-link,
        .speed-mode,
        .speed-start {
            border: 1px solid #d9b8ae;
            border-radius: 14px;
            padding: 12px 18px;
            background: #fffaf6;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
        }

        .speed-mode.is-active {
            border-color: #a95f4c;
            background: #ead1c8;
        }

        .speed-start {
            width: 100%;
            background: #16a34a;
            border-color: #16a34a;
            color: #fff !important;
            font-size: 18px;
        }

        .speed-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 20px;
        }

        .speed-card,
        .speed-panel {
            background: #fffdfb;
            border: 1px solid #eadcd2;
            border-radius: 22px;
            box-shadow: 0 18px 50px rgba(45, 36, 32, .07);
        }

        .speed-card {
            display: grid;
            grid-template-columns: 360px minmax(0, 1fr);
            gap: 34px;
            align-items: center;
            min-height: 360px;
            padding: 34px;
        }

        .speed-gauge {
            width: 260px;
            height: 260px;
            display: grid;
            place-items: center;
            border: 34px solid #ead1c8;
            border-radius: 50%;
            background: #fff;
            margin: 0 auto;
        }

        .speed-number {
            font-size: 58px;
            line-height: 1;
            font-weight: 950;
        }

        .speed-unit {
            display: block;
            margin-top: 8px;
            font-weight: 800;
            opacity: .68;
            text-align: center;
        }

        .speed-state {
            margin-top: 18px;
            text-align: center;
            font-size: 20px;
            font-weight: 900;
        }

        .speed-controls {
            display: grid;
            gap: 22px;
        }

        .speed-modes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .speed-panel {
            padding: 24px;
        }

        .speed-metric {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 18px 0;
            border-bottom: 1px solid #eadcd2;
        }

        .speed-metric:last-child {
            border-bottom: 0;
        }

        .speed-label {
            display: block;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .speed-value {
            display: block;
            margin-top: 8px;
            font-size: 24px;
            font-weight: 950;
        }

        .speed-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #f3e1da;
            font-weight: 950;
        }

        .speed-progress {
            margin-top: 20px;
            padding: 24px 28px;
        }

        .speed-progress-row {
            margin-bottom: 24px;
        }

        .speed-progress-row:last-child {
            margin-bottom: 0;
        }

        .speed-progress-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 900;
        }

        .speed-track {
            height: 14px;
            overflow: hidden;
            border-radius: 999px;
            background: #eadcd2;
        }

        .speed-bar {
            height: 100%;
            width: 0%;
            border-radius: inherit;
            background: #a95f4c;
            transition: width .2s ease;
        }

        .speed-history {
            margin-top: 20px;
            overflow: hidden;
        }

        .speed-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .speed-history th,
        .speed-history td {
            padding: 14px 16px;
            border-bottom: 1px solid #eadcd2;
            text-align: left;
        }

        .speed-note {
            margin-top: 20px;
            padding: 16px 18px;
            border-radius: 16px;
            background: #fffdfb;
            border: 1px solid #eadcd2;
            font-weight: 700;
        }

        @media (max-width: 1100px) {
            .speed-layout,
            .speed-card {
                grid-template-columns: 1fr;
            }

            .speed-head {
                flex-direction: column;
            }
        }
    </style>

    <div class="joya-speed" data-speed-test>
        <div class="speed-head">
            <div>
                <span class="speed-pill">Network Tools</span>
                <h2>Speed Test</h2>
                <p class="speed-muted">Measure ping, download, and upload speed between this browser and {{ request()->getHost() }}.</p>
            </div>
            <div class="speed-actions">
                <a class="speed-link" href="https://fast.com" target="_blank" rel="noreferrer">Fast.com</a>
                <a class="speed-link" href="https://www.speedtest.net" target="_blank" rel="noreferrer">Speedtest.net</a>
            </div>
        </div>

        <div class="speed-layout">
            <section class="speed-card">
                <div>
                    <div class="speed-gauge">
                        <div>
                            <span class="speed-number" data-speed-number>0.0</span>
                            <span class="speed-unit">Mbps</span>
                        </div>
                    </div>
                    <div class="speed-state" data-speed-state>Ready</div>
                </div>

                <div class="speed-controls">
                    <div class="speed-modes">
                        <button class="speed-mode" type="button" data-mode="quick">Quick</button>
                        <button class="speed-mode is-active" type="button" data-mode="standard">Standard</button>
                        <button class="speed-mode" type="button" data-mode="detailed">Detailed</button>
                    </div>
                    <button class="speed-start" type="button" data-start-test>Start Test</button>
                </div>
            </section>

            <aside class="speed-panel">
                <div class="speed-metric">
                    <div>
                        <span class="speed-label">Ping</span>
                        <span class="speed-value" data-ping>--</span>
                    </div>
                    <span class="speed-icon">ms</span>
                </div>
                <div class="speed-metric">
                    <div>
                        <span class="speed-label">Download</span>
                        <span class="speed-value" data-download>--</span>
                    </div>
                    <span class="speed-icon">DL</span>
                </div>
                <div class="speed-metric">
                    <div>
                        <span class="speed-label">Upload</span>
                        <span class="speed-value" data-upload>--</span>
                    </div>
                    <span class="speed-icon">UL</span>
                </div>
                <div class="speed-metric">
                    <div>
                        <span class="speed-label">Server</span>
                        <span class="speed-value">{{ request()->getHost() }}</span>
                    </div>
                    <span class="speed-icon">SRV</span>
                </div>
            </aside>
        </div>

        <section class="speed-panel speed-progress">
            <div class="speed-progress-row">
                <div class="speed-progress-title">
                    <span>Download progress</span>
                    <span data-download-progress-text>0%</span>
                </div>
                <div class="speed-track"><div class="speed-bar" data-download-progress></div></div>
            </div>
            <div class="speed-progress-row">
                <div class="speed-progress-title">
                    <span>Upload progress</span>
                    <span data-upload-progress-text>0%</span>
                </div>
                <div class="speed-track"><div class="speed-bar" data-upload-progress></div></div>
            </div>
        </section>

        <section class="speed-panel speed-history">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Mode</th>
                        <th>Ping</th>
                        <th>Download</th>
                        <th>Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->recentResults as $result)
                        <tr>
                            <td>{{ $result->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ ucfirst($result->test_mode) }}</td>
                            <td>{{ number_format($result->ping_ms, 1) }} ms</td>
                            <td>{{ number_format($result->download_mbps, 1) }} Mbps</td>
                            <td>{{ number_format($result->upload_mbps, 1) }} Mbps</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No speed tests saved yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <div class="speed-note">
            This built-in test measures your connection to the website server. Use Fast.com or Speedtest.net for public internet comparison against their own servers.
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-speed-test]');
            if (!root || root.dataset.ready === 'true') return;
            root.dataset.ready = 'true';

            const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
            const routes = {
                ping: @json(route('admin.speed-test.ping')),
                download: @json(route('admin.speed-test.download')),
                upload: @json(route('admin.speed-test.upload')),
                save: @json(route('admin.speed-test.results')),
            };
            const sizes = {
                quick: 262144,
                standard: 1048576,
                detailed: 4194304,
            };
            let mode = 'standard';

            const ui = {
                number: root.querySelector('[data-speed-number]'),
                state: root.querySelector('[data-speed-state]'),
                ping: root.querySelector('[data-ping]'),
                download: root.querySelector('[data-download]'),
                upload: root.querySelector('[data-upload]'),
                start: root.querySelector('[data-start-test]'),
                downloadBar: root.querySelector('[data-download-progress]'),
                uploadBar: root.querySelector('[data-upload-progress]'),
                downloadText: root.querySelector('[data-download-progress-text]'),
                uploadText: root.querySelector('[data-upload-progress-text]'),
            };

            const setProgress = (kind, percent) => {
                const value = `${Math.max(0, Math.min(100, Math.round(percent)))}%`;
                ui[`${kind}Bar`].style.width = value;
                ui[`${kind}Text`].textContent = value;
            };

            root.querySelectorAll('[data-mode]').forEach((button) => {
                button.addEventListener('click', () => {
                    mode = button.dataset.mode;
                    root.querySelectorAll('[data-mode]').forEach((item) => item.classList.remove('is-active'));
                    button.classList.add('is-active');
                });
            });

            const measurePing = async () => {
                const samples = [];

                for (let i = 0; i < 5; i++) {
                    const start = performance.now();
                    await fetch(`${routes.ping}?t=${Date.now()}-${i}`, {
                        cache: 'no-store',
                        credentials: 'same-origin',
                    });
                    samples.push(performance.now() - start);
                }

                return samples.reduce((total, sample) => total + sample, 0) / samples.length;
            };

            const measureDownload = async (size) => {
                const start = performance.now();
                const response = await fetch(`${routes.download}?size=${size}&t=${Date.now()}`, {
                    cache: 'no-store',
                    credentials: 'same-origin',
                });
                const reader = response.body.getReader();
                let received = 0;

                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;
                    received += value.length;
                    setProgress('download', (received / size) * 100);
                }

                const seconds = (performance.now() - start) / 1000;
                setProgress('download', 100);

                return (received * 8) / seconds / 1000000;
            };

            const measureUpload = (size) => new Promise((resolve, reject) => {
                const payload = new Uint8Array(size);
                const start = performance.now();
                const request = new XMLHttpRequest();

                request.open('POST', `${routes.upload}?t=${Date.now()}`);
                request.setRequestHeader('X-CSRF-TOKEN', csrf);
                request.setRequestHeader('Content-Type', 'application/octet-stream');
                request.upload.onprogress = (event) => {
                    if (event.lengthComputable) {
                        setProgress('upload', (event.loaded / event.total) * 100);
                    }
                };
                request.onload = () => {
                    if (request.status >= 200 && request.status < 300) {
                        const seconds = (performance.now() - start) / 1000;
                        setProgress('upload', 100);
                        resolve((size * 8) / seconds / 1000000);
                    } else {
                        reject(new Error('Upload failed'));
                    }
                };
                request.onerror = () => reject(new Error('Upload failed'));
                request.send(payload);
            });

            const saveResult = async (result) => {
                await fetch(routes.save, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(result),
                });
            };

            ui.start.addEventListener('click', async () => {
                ui.start.disabled = true;
                ui.start.textContent = 'Testing...';
                ui.state.textContent = 'Checking ping...';
                ui.ping.textContent = '--';
                ui.download.textContent = '--';
                ui.upload.textContent = '--';
                ui.number.textContent = '0.0';
                setProgress('download', 0);
                setProgress('upload', 0);

                try {
                    const size = sizes[mode];
                    const ping = await measurePing();
                    ui.ping.textContent = `${ping.toFixed(1)} ms`;

                    ui.state.textContent = 'Testing download...';
                    const download = await measureDownload(size);
                    ui.download.textContent = `${download.toFixed(1)} Mbps`;
                    ui.number.textContent = download.toFixed(1);

                    ui.state.textContent = 'Testing upload...';
                    const upload = await measureUpload(Math.max(65536, Math.floor(size / 2)));
                    ui.upload.textContent = `${upload.toFixed(1)} Mbps`;

                    ui.state.textContent = 'Saved';
                    await saveResult({
                        ping_ms: ping.toFixed(2),
                        download_mbps: download.toFixed(2),
                        upload_mbps: upload.toFixed(2),
                        test_mode: mode,
                    });

                    setTimeout(() => window.location.reload(), 900);
                } catch (error) {
                    ui.state.textContent = 'Test failed. Try again.';
                } finally {
                    ui.start.disabled = false;
                    ui.start.textContent = 'Start Test';
                }
            });
        })();
    </script>
</x-filament-panels::page>
