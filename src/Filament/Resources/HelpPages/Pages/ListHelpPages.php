<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;

class ListHelpPages extends ListRecords
{
    protected static string $resource = HelpPagesResource::class;

    protected static ?string $title = 'Manage Pages';

    protected static ?string $navigationLabel = 'Manage Pages';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add a Page'),
        ];
    }
}
