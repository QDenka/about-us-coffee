<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Filament\Concerns\HasTranslationFields;
use App\Filament\Components\OptimizedFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    use HasTranslationFields;
    
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
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
                        Textarea::make('bio_en')
                            ->label('Bio (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('bio');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('bio') ?? [];
                                $viState = $get('bio_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('bio'),
                        Textarea::make('bio_vi')
                            ->label('Bio (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('bio');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                    ]),
                OptimizedFileUpload::make('image')
                    ->maxDimensions(600, 800)
                    ->quality(85)
                    ->image()
                    ->disk('public')
                    ->directory('team'),

                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
