<?php

namespace App\Filament\Resources\ContactSubmissions\Pages;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactSubmission extends ViewRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('mark_as_read')
                ->label('Mark as Read')
                ->icon('heroicon-o-eye')
                ->visible(fn () => $this->record->status === 'unread')
                ->action(fn () => $this->record->markAsRead()),
        ];
    }

    public function mount($record): void
    {
        parent::mount($record);
        
        // Auto-mark as read when viewing
        if ($this->record->status === 'unread') {
            $this->record->markAsRead();
        }
    }
}