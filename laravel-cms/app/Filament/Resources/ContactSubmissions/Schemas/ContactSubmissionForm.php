<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\DateTimePicker;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->disabled(),

                Textarea::make('message')
                    ->required()
                    ->maxLength(2000)
                    ->rows(4)
                    ->disabled(),

                TextInput::make('ip_address')
                    ->label('IP Address')
                    ->disabled(),

                TextInput::make('user_agent')
                    ->label('User Agent')
                    ->disabled(),

                Select::make('status')
                    ->options([
                        'unread' => 'Unread',
                        'read' => 'Read',
                        'replied' => 'Replied',
                        'spam' => 'Spam',
                    ])
                    ->required(),

                DateTimePicker::make('read_at')
                    ->label('Read At')
                    ->disabled(),

                DateTimePicker::make('created_at')
                    ->label('Submitted At')
                    ->disabled(),
            ]);
    }
}