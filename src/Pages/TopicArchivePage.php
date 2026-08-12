<?php

namespace PaperLeaf\HelpGuide\Pages;

use Filament\Pages\Page;
use Livewire\Attributes\Computed;
use PaperLeaf\HelpGuide\Models\Topic;

class TopicArchivePage extends Page
{
    protected string $view = 'help-guide::pages.topic-page';

    public function getTitle(): string
    {
        return "Topic: {$this->record->title}";
    }

    public function getSubheading(): ?string
    {
        return $this->record->description;
    }

    protected static ?string $slug = 'pages/{record}';

    public Topic $record;

    // These pages are registered dynamically in the HelpGuidePanelProvider
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getBreadcrumbs(): array
    {
        return [
            WelcomePage::getUrl() => 'Help Guide',
            '' => $this->record->title,
        ];
    }

    #[Computed]
    public function helpPages()
    {
        return $this->record->pages()
            ->orderBy('nav_order')
            ->get();
    }
}
