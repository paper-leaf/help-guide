<?php

namespace PaperLeaf\HelpGuide\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Computed;
use PaperLeaf\HelpGuide\Models\HelpPage;

use PaperLeaf\HelpGuide\Models\Enums\Status;

class WelcomePage extends Page
{
    protected string $view = 'help-guide::pages.welcome-page';

    protected static ?string $title = 'Help Guide';
    protected static ?string $navigationLabel = 'Help Guide';

    protected static ?string $slug = 'welcome';

    public function getHeading(): string | Htmlable | null
    {
        return '';
    }

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;

    #[Computed]
    public function featuredArticles()
    {
        return HelpPage::query()
            ->where('is_featured', true)
            ->where('status', Status::PUBLISHED)
            ->get();
    }
}
