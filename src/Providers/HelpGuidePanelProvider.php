<?php

namespace PaperLeaf\HelpGuide\Providers;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use PaperLeaf\HelpGuide\Http\Middleware\RedirectGuests;
use PaperLeaf\HelpGuide\Pages\WelcomePage;

class HelpGuidePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('help-guide')
            ->path('help-guide')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                VerifyCsrfToken::class,
            ])
            ->pages([
                WelcomePage::class,
            ])
            ->authGuard('web')
            ->authMiddleware([
                RedirectGuests::class,
            ])
            ->viteTheme('resources/css/app.css')
            ->brandName(globalValue('site_name'))
            ->brandLogo(globalValue('logo'))
            ->brandLogoHeight('3.2rem')
            ->favicon(globalValue('favicon'))
            ->discoverClusters(
                in: __DIR__ . '/../Filament/Clusters',
                for: 'PaperLeaf\\HelpGuide\\Filament\\Clusters'
            )
            ->discoverResources(
                in: __DIR__ . '/../Filament/Resources',
                for: 'PaperLeaf\\HelpGuide\\Filament\\Resources'
            );
    }
}
