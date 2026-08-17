<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Models\SiteSetting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName(fn (): string => SiteSetting::current()->site_name)
            ->brandLogo(fn (): ?string => SiteSetting::current()->logo ? asset('storage/' . SiteSetting::current()->logo) : null)
            ->darkModeBrandLogo(fn (): ?string => SiteSetting::current()->logo ? asset('storage/' . SiteSetting::current()->logo) : null)
            ->favicon(fn (): ?string => SiteSetting::current()->favicon ? asset('storage/' . SiteSetting::current()->favicon) : null)
            ->brandLogoHeight('2.25rem')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => [
                    50 => '#fdf7f3',
                    100 => '#faeee8',
                    200 => '#f1d7d0',
                    300 => '#e4b5aa',
                    400 => '#d28b7b',
                    500 => '#b86b57',
                    600 => '#9b4f3f',
                    700 => '#7d3c31',
                    800 => '#5d2d25',
                    900 => '#3a2b27',
                    950 => '#241916',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
