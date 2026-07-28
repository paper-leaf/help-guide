<?php

namespace App\Filament\Resources\HelpPages\Pages;

use App\Filament\Resources\HelpPages\LocalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

use App\Filament\Resources\RelationManagers\LogsRelationManager;

class ViewLocal extends ViewRecord
{
    protected static string $resource = LocalResource::class;

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
