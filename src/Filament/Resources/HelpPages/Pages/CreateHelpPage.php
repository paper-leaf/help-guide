<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages;

use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateHelpPage extends CreateRecord
{
    protected static string $resource = HelpPagesResource::class;

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Create & add another');
    }
}
