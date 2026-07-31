<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use PaperLeaf\HelpGuide\Filament\Clusters\ManageCluster;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\CreateHelpPage;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\EditHelpPage;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\ListHelpPages;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas\HelpPageForm;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas\LocalInfolist;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Tables\HelpPagesTable;
use PaperLeaf\HelpGuide\Models\HelpPage;
use PaperLeaf\HelpGuide\Services\PermissionsService;

class HelpPagesResource extends Resource
{
    protected static ?string $model = HelpPage::class;

    protected static ?int $navigationSort = 5;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document';

    protected static ?string $cluster = ManageCluster::class;

    protected static ?string $navigationLabel = 'Pages';

    public static function canAccess(): bool
    {
        $service = new PermissionsService();
        return $service->canManageGuide();
    }

    public static function form(Schema $schema): Schema
    {
        return HelpPageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LocalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HelpPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHelpPages::route('/'),
            'create' => CreateHelpPage::route('/create'),
            'edit' => EditHelpPage::route('/{record:slug}/edit'),
        ];
    }
}
