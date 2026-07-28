<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages;

use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

use App\Filament\Resources\RelationManagers\LogsRelationManager;

class ViewHelpPage extends ViewRecord
{
    protected static string $resource = HelpPagesResource::class;

    protected function getAllRelationManagers(): array
    {
        return [
            LogsRelationManager::class,
        ];
    }

    public function getBreadcrumbs(): array
    {
        return $this->getResource()::breadcrumbs(
            optional($this->record)->name,
        );
    }
}
