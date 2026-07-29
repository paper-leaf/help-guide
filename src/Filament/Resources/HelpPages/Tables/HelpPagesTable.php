<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HelpPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('topic.title')
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->recordActions([
                ViewAction::make()
                    ->button()
                    ->url(fn ($record) => $record->page_url)
                    ->color('primary'),

                ActionGroup::make([
                    EditAction::make()
                        ->color('primary'),

                    DeleteAction::make()
                        ->color('danger'),
                ]),
            ]);
    }
}
