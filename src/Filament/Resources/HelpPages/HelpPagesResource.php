<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages;

// use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\CreateLocal;
// use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\EditLocal;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\ListHelpPages;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Pages\ViewHelpPage;
// use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas\LocalForm;
// use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas\LocalInfolist;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Tables\HelpPagesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use PaperLeaf\HelpGuide\Models\HelpPage;

use App\Filament\Extends\BaseResource;

class HelpPagesResource extends BaseResource
{
    protected static ?string $model = HelpPage::class;

    protected static ?int $navigationSort = 5;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel = 'Manage pages';

    public static function form(Schema $schema): Schema
    {
        return LocalForm::configure($schema);
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
            'view' => ViewHelpPage::route('/{record}'),
        ];
    }
}
