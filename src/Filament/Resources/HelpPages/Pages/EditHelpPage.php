<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages;

use Filament\Resources\Pages\EditRecord;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;

class EditHelpPage extends EditRecord
{
    protected static string $resource = HelpPagesResource::class;

    protected function afterSave(): void
    {
        // Dispatches to the global window listener that updates the sidebar layout
        $this->dispatch('refresh-sidebar');
    }
}
