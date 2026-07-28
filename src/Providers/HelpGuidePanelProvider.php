<?php

namespace PaperLeaf\HelpGuide\Providers;

use Filament\Panel;
use Filament\PanelProvider;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\Authenticate;

use PaperLeaf\HelpGuide\Http\Middleware\RedirectGuests;

use PaperLeaf\HelpGuide\HelpGuidePlugin;

class HelpGuidePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('help-guide')
            ->path('help-guide')
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                \Filament\Http\Middleware\DisableBladeIconComponents::class,
                \Filament\Http\Middleware\DispatchServingFilamentEvent::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            ])
            ->pages([
                \PaperLeaf\HelpGuide\Pages\WelcomePage::class, 
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
            ->discoverResources(
                in: __DIR__ . '/../Filament/Resources', 
                for: 'PaperLeaf\\HelpGuide\\Filament\\Resources'
            );
    }
}