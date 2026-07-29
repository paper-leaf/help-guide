<?php

namespace PaperLeaf\HelpGuide\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Computed;

use PaperLeaf\HelpGuide\Models\HelpPage;

class WelcomePage extends Page
{
    protected string $view = 'help-guide::pages.welcome-page';

    protected static ?string $title = 'Home';

    public function getHeading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return '';
    }

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;

    #[Computed]
    public function featuredArticles()
    {
        return HelpPage::query()
                    ->where('is_featured', true)
                    ->get();
    }
}
