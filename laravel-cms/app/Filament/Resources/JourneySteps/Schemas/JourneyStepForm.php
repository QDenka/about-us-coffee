<?php

namespace App\Filament\Resources\JourneySteps\Schemas;

use App\Filament\Concerns\HasTranslationFields;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class JourneyStepForm
{
    use HasTranslationFields;
    
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('step_number')
                    ->required()
                    ->numeric(),
                Grid::make(2)
                    ->schema([
                        Textarea::make('title_en')
                            ->label('Title (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('title');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('title') ?? [];
                                $viState = $get('title_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('title'),
                        Textarea::make('title_vi')
                            ->label('Title (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('title');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                        Textarea::make('description_en')
                            ->label('Description (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('description');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('description') ?? [];
                                $viState = $get('description_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('description'),
                        Textarea::make('description_vi')
                            ->label('Description (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('description');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                    ]),
                TextInput::make('icon'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
