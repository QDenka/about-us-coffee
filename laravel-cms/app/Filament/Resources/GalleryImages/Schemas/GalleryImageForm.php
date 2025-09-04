<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use App\Filament\Concerns\HasTranslationFields;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GalleryImageForm
{
    use HasTranslationFields;
    
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Textarea::make('title_en')
                            ->label('Title (English)')
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
                        Textarea::make('alt_text_en')
                            ->label('Alt Text (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('alt_text');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('alt_text') ?? [];
                                $viState = $get('alt_text_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('alt_text'),
                        Textarea::make('alt_text_vi')
                            ->label('Alt Text (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('alt_text');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                    ]),
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->required(),
                TextInput::make('thumbnail_path'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
