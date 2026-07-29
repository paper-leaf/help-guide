<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\Topics\Schemas;

use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Topic')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Page slug')
                    ->belowLabel('Set the URL slug for the page that displays all help pages for this topic.')
                    ->required()
                    ->columnSpanFull(),

                TextArea::make('description')
                    ->label('Short description')
                    ->belowLabel('Briefly describe what this topic contains.')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
