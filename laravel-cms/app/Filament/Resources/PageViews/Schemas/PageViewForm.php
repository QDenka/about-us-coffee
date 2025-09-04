<?php

namespace App\Filament\Resources\PageViews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PageViewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->required(),
                TextInput::make('page_title'),
                TextInput::make('ip_address')
                    ->required(),
                Textarea::make('user_agent')
                    ->columnSpanFull(),
                TextInput::make('referer'),
                TextInput::make('session_id'),
                DateTimePicker::make('viewed_at')
                    ->required(),
                Textarea::make('metadata')
                    ->columnSpanFull(),
            ]);
    }
}
