<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Toggle;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('section_key')
                    ->label('Section Key')
                    ->required()
                    ->maxLength(50)
                    ->disabled(fn ($record) => $record?->is_required),

                Toggle::make('is_visible')
                    ->label('Visible')
                    ->default(true)
                    ->disabled(fn ($record) => $record?->is_required),

                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_required')
                    ->label('Required')
                    ->default(false)
                    ->disabled()
                    ->helperText('Required sections cannot be hidden or deleted'),
            ]);
    }
}