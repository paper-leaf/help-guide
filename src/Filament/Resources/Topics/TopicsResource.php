<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\Topics;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use PaperLeaf\HelpGuide\Filament\Clusters\ManageCluster;
use PaperLeaf\HelpGuide\Filament\Resources\Topics\Pages\ListTopics;
use PaperLeaf\HelpGuide\Filament\Resources\Topics\Pages\ViewTopic;
use PaperLeaf\HelpGuide\Filament\Resources\Topics\Schemas\TopicForm;
use PaperLeaf\HelpGuide\Filament\Resources\Topics\Tables\TopicsTable;
use PaperLeaf\HelpGuide\Models\Topic;
use PaperLeaf\HelpGuide\Services\PermissionsService;

class TopicsResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?int $navigationSort = 5;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-tag';

    protected static ?string $cluster = ManageCluster::class;

    protected static ?string $navigationLabel = 'Topics';

    public static function canAccess(): bool
    {
        $service = new PermissionsService;

        return $service->canManageGuide();
    }

    public static function form(Schema $schema): Schema
    {
        return TopicForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TopicsTable::configure($table);
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
            'index' => ListTopics::route('/'),
            'view' => ViewTopic::route('/{record}'),
        ];
    }
}
