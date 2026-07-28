<?php

namespace App\Filament\Resources\HelpPages\Pages;

use App\Filament\Resources\HelpPages\LocalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

use App\Models\Enums\Status;

class ListHelpPages extends ListRecords
{
    protected static string $resource = LocalResource::class;

    /**
     * Get the tabs for the list page.
     *
     * @return array
     */
    public function getTabs(): array
    {
        return [
            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::ACTIVE->value)),
            'archived' => Tab::make('Archived')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::ARCHIVED->value)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Local')
                ->modal(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return $this->getResource()::breadcrumbs();
    }
}
