<?php

namespace PaperLeaf\HelpGuide\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

use PaperLeaf\HelpGuide\Models\HelpPage;
use PaperLeaf\HelpGuide\Models\Topic;

class ViewHelpPage extends Page
{
    // protected static ?string $model = HelpPage::class;

    protected string $view = 'help-guide::pages.welcome-page';

    protected static ?string $title = 'test';
    protected static ?string $slug = 'pages/{topic}/{record}';

    public HelpPage $record;
    public $topic;

    // These pages are registered dynamically in the HelpGuidePanelProvider
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount($record, $topic): void
    {
        $this->topic = $topic; 
    }
}
