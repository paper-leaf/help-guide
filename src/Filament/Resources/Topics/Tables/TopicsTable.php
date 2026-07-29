<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\Topics\Tables;

use Illuminate\Database\Eloquent\Builder;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TopicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->grow()
                    ->sortable(),

                TextColumn::make('pages_count')
                    ->label('Pages with this Topic')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->counts('pages'),
            ])
            ->filters([
                //
            ])
            ->recordUrl(null)
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->color('primary'),

                    DeleteAction::make()
                        ->color('danger'),
                ])
            ]);
    }
}
