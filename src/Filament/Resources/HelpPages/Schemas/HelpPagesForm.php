<?php

namespace PaperLeaf\HelpGuide\Filament\Resources\HelpPages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use App\Models\City;

use App\Models\Enums\Status;

class LocalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('local_number')
                    ->required(),

                TextInput::make('title')
                    ->required(),

                Select::make('city_id')
                    ->label('City')
                    ->options(fn() => City::where('status', Status::ACTIVE)->pluck('title', 'id'))
                    ->searchable()
                    ->columnSpanFull(),
            ]);
    }
}
