<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;

class CreateHelpPage extends CreateRecord
{
    protected static string $resource = HelpPagesResource::class;

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Create & add another');
    }
}
