<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\Topics\Pages;

use PaperLeaf\HelpGuide\Filament\Resources\Topics\TopicsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTopics extends ListRecords
{
    protected static string $resource = TopicsResource::class;

    protected static ?string $title = 'Manage Topics';
    protected static ?string $navigationLabel = 'Manage Topics';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add a Topic'),
        ];
    }
}
