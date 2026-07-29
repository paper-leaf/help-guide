<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Tables;

use Illuminate\Database\Eloquent\Builder;

use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
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

                // TextColumn::make('name')
                //     ->sortable(query: function (Builder $query, string $direction) {
                //         return $query->orderByRaw('CAST(local_number AS SIGNED) ' . $direction);
                //     })
                //     ->searchable()
                //     ->grow(),

                // TextColumn::make('city.title')
                //     ->sortable()
                //     ->default('-'),

                // TextColumn::make('citizens_count')
                //     ->label('Citizens and applicants in Local')
                //     ->sortable()
                //     ->badge()
                //     ->color('info')
                //     ->counts('citizens'),
            ])
            ->filters([
                //
            ])
            ->recordUrl(null)
            ->recordActions([
                ViewAction::make()->button()->color('primary'),

                ActionGroup::make([
                    EditAction::make()
                        ->color('primary'),

                    DeleteAction::make()
                        ->color('danger'),
                ])
            ]);
    }
}
