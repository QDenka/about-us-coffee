<?php

namespace App\Filament\Resources\HeroSettings\Schemas;

use App\Filament\Components\OptimizedFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('English')
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (English)')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Vietnamese')
                    ->schema([
                        TextInput::make('title.vi')
                            ->label('Title (Vietnamese)')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                TextInput::make('subtitle')
                    ->label('Subtitle (English only)')
                    ->required()
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        if ($record && is_array($record->subtitle)) {
                            $component->state($record->subtitle['en'] ?? '');
                        } elseif ($record && is_string($record->subtitle)) {
                            $component->state($record->subtitle);
                        }
                    })
                    ->dehydrateStateUsing(function ($state, $get, $record) {
                        return $state;
                    })
                    ->columnSpanFull(),
                OptimizedFileUpload::make('background_image')
                    ->maxDimensions(1920, 1080)
                    ->quality(85)
                    ->label('Background Image')
                    ->image()
                    ->disk('public')
                    ->directory('hero-backgrounds')
                    ->columnSpanFull(),
            ]);
    }
}
