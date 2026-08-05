<?php

namespace PaperLeaf\HelpGuide\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Facades\Filament;
use Livewire\Attributes\Computed;

class GuideWidget extends Widget
{
    protected string $view = 'help-guide::filament.widgets.guide-widget';

    #[Computed]
    public function guideUrl()
    {
        return url(Filament::getPanel('help-guide')->getPath());
    }
}
