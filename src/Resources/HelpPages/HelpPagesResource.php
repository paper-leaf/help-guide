<?php

namespace App\Filament\Resources\HelpPages;

use App\Filament\Resources\HelpPages\Pages\CreateLocal;
use App\Filament\Resources\HelpPages\Pages\EditLocal;
use App\Filament\Resources\HelpPages\Pages\ListHelpPages;
use App\Filament\Resources\HelpPages\Pages\ViewLocal;
use App\Filament\Resources\HelpPages\Schemas\LocalForm;
use App\Filament\Resources\HelpPages\Schemas\LocalInfolist;
use App\Filament\Resources\HelpPages\Tables\HelpPagesTable;
use App\Models\Local;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use App\Filament\Clusters\Terms;
use App\Filament\Extends\BaseResource;

class LocalResource extends BaseResource
{
    protected static ?string $model = Local::class;

    // protected static ?string $cluster = Terms::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $model_label = 'Métis Local';
    // protected static ?string $pluralModelLabel = 'Métis HelpPages';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

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
            'view' => ViewLocal::route('/{record}'),
        ];
    }
}
