<?php

namespace App\Filament\Resources\ContactSubmissions;

use App\Filament\Resources\ContactSubmissions\Pages\CreateContactSubmission;
use App\Filament\Resources\ContactSubmissions\Pages\EditContactSubmission;
use App\Filament\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Filament\Resources\ContactSubmissions\Pages\ViewContactSubmission;
use App\Filament\Resources\ContactSubmissions\Schemas\ContactSubmissionForm;
use App\Filament\Resources\ContactSubmissions\Tables\ContactSubmissionTable;
use App\Models\ContactSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?string $navigationBadge = '';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return ContactSubmission::unread()->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return ContactSubmissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactSubmissionTable::configure($table);
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
            'index' => ListContactSubmissions::route('/'),
            'create' => CreateContactSubmission::route('/create'),
            'view' => ViewContactSubmission::route('/{record}'),
            'edit' => EditContactSubmission::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Don't allow manual creation
    }
}