<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

use App\Filament\Concerns\HasTranslationFields;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FooterSettingsForm
{
    use HasTranslationFields;
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contact_email')
                    ->email()
                    ->required(),
                TextInput::make('contact_phone')
                    ->tel()
                    ->required(),
                Grid::make(2)
                    ->schema([
                        Textarea::make('address_en')
                            ->label('Address (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('address');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('address') ?? [];
                                $viState = $get('address_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('address'),
                        Textarea::make('address_vi')
                            ->label('Address (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('address');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                        Textarea::make('opening_hours_en')
                            ->label('Opening Hours (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('opening_hours');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('opening_hours') ?? [];
                                $viState = $get('opening_hours_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('opening_hours'),
                        Textarea::make('opening_hours_vi')
                            ->label('Opening Hours (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('opening_hours');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                        Textarea::make('copyright_text_en')
                            ->label('Copyright Text (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('copyright_text');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('copyright_text') ?? [];
                                $viState = $get('copyright_text_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('copyright_text'),
                        Textarea::make('copyright_text_vi')
                            ->label('Copyright Text (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('copyright_text');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                    ]),
                TextInput::make('social_facebook'),
                TextInput::make('social_instagram'),
                TextInput::make('social_youtube'),
            ]);
    }
}
