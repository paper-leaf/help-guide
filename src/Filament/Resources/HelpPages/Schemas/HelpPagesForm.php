<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use PaperLeaf\HelpGuide\Models\Enums\Status;
use PaperLeaf\HelpGuide\Models\Topic;

class HelpPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 3,
                ])
                    ->columnSpanFull()
                    ->schema([
                        Section::make()
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Page title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (?string $state, ?string $old, $set) {
                                        // Don't make any dynamic changes if a value is previously set
                                        if (isset($old) && $old != '') {
                                            return;
                                        }

                                        // Create a slug from the page title
                                        $slug = Str::slug($state);
                                        $set('slug', $slug);
                                    }),

                                Select::make('topic_id')
                                    ->label('Topic')
                                    ->belowLabel('Group this page with other pages on the same topic.')
                                    ->options(fn () => Topic::query()->pluck('title', 'id'))
                                    ->searchable(),

                                TextInput::make('icon')
                                    ->required()
                                    ->belowLabel('Set an icon to represent this page in the navigation.')
                                    ->placeholder('heroicon-o-face-smile'),

                                TextArea::make('description')
                                    ->label('Short description')
                                    ->belowLabel('Briefly describe what this page covers.')
                                    ->required(),

                                RichEditor::make('content')
                                    ->label('Page content')
                                    ->required()
                                    ->toolbarButtons([
                                        ['bold', 'italic', 'underline', 'strike', 'link'],
                                        ['h2', 'h3', 'h4'],
                                        ['bulletList', 'orderedList'],
                                        ['undo', 'redo'],
                                    ]),
                            ]),

                        Section::make()
                            ->schema([
                                ToggleButtons::make('status')
                                    ->label('Page status')
                                    ->options(function () {
                                        return collect(Status::cases())
                                            ->mapWithKeys(fn ($enum) => [$enum->value => $enum->getLabel()])
                                            ->toArray();
                                    })
                                    ->default(Status::DRAFT->value)
                                    ->required()
                                    ->inline(),

                                TextInput::make('nav_order')
                                    ->label('Order in navigation')
                                    ->belowLabel('Set the display order for this page within its topic. Lower numbers appear first.')
                                    ->numeric()
                                    ->default(1)
                                    ->step(1),

                                TextInput::make('slug')
                                    ->label('Page slug')
                                    ->required()
                                    ->unique(),
                            ]),
                    ]),
            ]);
    }
}
