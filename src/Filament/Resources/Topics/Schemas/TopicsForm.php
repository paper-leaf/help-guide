<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\Topics\Schemas;

use Illuminate\Support\Str;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use PaperLeaf\HelpGuide\Models\Topic;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Topic')
                    ->required()
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state, ?string $old, $set) {
                        // Don't make any dynamic changes if a value is previously set
                        if(isset($old) && $old != '') {
                            return;
                        }

                        // Create a slug from the page title
                        $slug = Str::slug($state);
                        $set('slug', $slug);
                    }),

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
