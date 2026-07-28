<?php

namespace App\Filament\Resources\HelpPages\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;

use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Flex;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

use App\Helpers\FormattingHelper;

use App\Models\Enums\Status;

class LocalInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $citizens_in_local = $schema->getRecord()->citizens()->count();
        $archive_disabled = $citizens_in_local > 0;

        return $schema
            ->components([
                Section::make('Local details')
                    ->columnSpanFull()
                    ->columns([
                        'xs' => 1,
                        'md' => 2,
                        'lg' => 3,
                    ])
                    ->schema([
                        TextEntry::make('local_number')
                            ->label('Local number')
                            ->default('-'),

                        TextEntry::make('title')
                            ->label('Local name'),

                        TextEntry::make('city.title')
                            ->label('City')
                            ->default('-')
                            ->badge()
                            ->color('info'),

                        TextEntry::make('citizens')
                            ->label('Citizens and applicants in local')
                            ->state($citizens_in_local)
                            ->badge()
                            ->color('info')
                            ->columnStart(1),

                        TextEntry::make('status')
                            ->badge()
                            ->label('Local status'),

                        TextEntry::make('created_at')
                            ->label('Created on')
                            ->date(),
                    ])
                    ->headerActions([
                        Action::make('archive')
                            ->label('Archive Local')
                            ->color('danger')
                            ->outlined()
                            ->size(Size::Medium)
                            ->requiresConfirmation()
                            ->modalHeading('Archive Local')
                            ->modalDescription('Archiving this Local will make it unavailable to assign to citizens and applicants. Are you sure you want to proceed?')
                            ->modalSubmitActionLabel('Yes, archive')
                            ->visible(fn($record) => $record->status === Status::ACTIVE)
                            ->disabled($archive_disabled)
                            ->tooltip(fn() => ($archive_disabled) ? 'HelpPages cannot be archived if they are currently assigned to an applicant or citizen\'s profile.' : null)
                            ->authorize('delete')
                            ->action(function ($record, Action $action, $livewire) {
                                $record->status = Status::ARCHIVED;
                                $record->update();

                                $livewire->dispatch('refresh-logs');

                                Notification::make()
                                    ->title('Local archived successfully')
                                    ->success()
                                    ->send();
                            }),

                        Action::make('setActive')
                            ->label('Activate Local')
                            ->color('success')
                            ->outlined()
                            ->size(Size::Medium)
                            ->requiresConfirmation()
                            ->modalHeading('Activate Local')
                            ->modalDescription('Activating this Local will make it available to assign to citizens and applicants. Are you sure you want to proceed?')
                            ->modalSubmitActionLabel('Yes, activate')
                            ->visible(fn ($record) => $record->status === Status::ARCHIVED)
                            ->authorize('delete')
                            ->action(function ($record, Action $action, $livewire) {
                                $record->status = Status::ACTIVE;
                                $record->update();

                                $livewire->dispatch('refresh-logs');

                                Notification::make()
                                    ->title('Local set to active successfully')
                                    ->success()
                                    ->send();
                            }),

                        EditAction::make()
                            ->outlined()
                            ->size(Size::Medium)
                            ->authorize('update')
                            ->extraAttributes(['class' => 'block -mt-2'])
                            ->modal()
                            ->after(function ($livewire) { 
                                $livewire->dispatch('refresh-logs');
                            }),
                    ]),
            ]);
    }
}
