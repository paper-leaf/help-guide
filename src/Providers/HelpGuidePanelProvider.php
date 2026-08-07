<?php

namespace PaperLeaf\HelpGuide\Providers;

use Illuminate\Support\Facades\Schema;
use Filament\Facades\Filament;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use PaperLeaf\HelpGuide\Http\Middleware\RedirectGuests;
use PaperLeaf\HelpGuide\Models\Enums\Status;
use PaperLeaf\HelpGuide\Models\HelpPage;
use PaperLeaf\HelpGuide\Models\Topic;
use PaperLeaf\HelpGuide\Pages\TopicArchivePage;
use PaperLeaf\HelpGuide\Pages\ViewHelpPage;
use PaperLeaf\HelpGuide\Pages\WelcomePage;

class HelpGuidePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('help-guide')
            ->path('help-guide')
            ->default(false)
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
                ViewHelpPage::class,
                TopicArchivePage::class,
            ])
            ->authGuard('web')
            ->authMiddleware([
                RedirectGuests::class,
            ])
            ->viteTheme('resources/css/app.css')
            ->brandName(fn () => Filament::getDefaultPanel()->getBrandName())
            ->brandLogo(fn () => Filament::getDefaultPanel()->getBrandLogo())
            ->brandLogoHeight(fn () => Filament::getDefaultPanel()->getBrandLogoHeight())
            ->favicon(fn () => Filament::getDefaultPanel()->getFavicon())
            ->discoverClusters(
                in: __DIR__ . '/../Filament/Clusters',
                for: 'PaperLeaf\\HelpGuide\\Filament\\Clusters'
            )
            ->discoverResources(
                in: __DIR__ . '/../Filament/Resources',
                for: 'PaperLeaf\\HelpGuide\\Filament\\Resources'
            )
            ->navigationGroups(self::generateNavigationGroups())
            ->navigationItems(self::generateNavigationItems())
            ->userMenu(false)
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
                fn (): string => Blade::render('help-guide::back-link'),
            );
    }

    /**
     * Generate the navigation items!
     *
     * @return array
     */
    private function generateNavigationItems()
    {
        if (!Schema::hasTable('help_guide_pages')) {
            return [];
        }

        // Query the pages
        $pages = HelpPage::query()
            ->where('status', Status::PUBLISHED)
            ->with('topic')
            ->get()
            ->map(function ($page) {
                // Group help pages by topic
                $topic = $page->topic;
                $group = (isset($topic)) ? $topic->title : 'Uncategorized';

                $route_name = 'filament.help-guide.manage.resources.help-pages.view';

                return NavigationItem::make($page->title)
                    ->url(fn () => $page->page_url)
                    ->isActiveWhen(fn () => request()->url() === $page->page_url)
                    ->icon($page->safe_icon)
                    ->group($group)
                    ->sort($page->nav_order)
                    ->visible(fn () => $page->canView());
            });

        return $pages->toArray();
    }

    /**
     * Generate + customize the navigation groups
     *
     * @return array
     */
    private function generateNavigationGroups()
    {
        if (!Schema::hasTable('help_guide_topics')) {
            return [];
        }

        // Query the topics
        return Topic::query()
            ->has('pages', '>', 0)
            ->orderBy('nav_order')
            ->pluck('title')
            ->toArray();
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
            function (): string {
                // Only output content if this is the default panel
                if (Filament::getCurrentPanel()?->getId() !== Filament::getDefaultPanel()?->getId()) {
                    return '';
                }

                return Blade::render('help-guide::guide-link');
            }
        );
    }
}
