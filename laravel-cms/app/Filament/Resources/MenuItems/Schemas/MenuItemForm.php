<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Filament\Concerns\HasTranslationFields;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class MenuItemForm
{
    use HasTranslationFields;
    
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Textarea::make('name_en')
                            ->label('Name (English)')
                            ->required()
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('name');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('name') ?? [];
                                $viState = $get('name_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('name'),
                        Textarea::make('name_vi')
                            ->label('Name (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('name');
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
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₫')
                    ->suffix('VND'),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('menu-items'),
                Select::make('category')
                    ->options([
                        'coffee' => 'Coffee',
                        'vietnamese' => 'Vietnamese',
                        'handbrew' => 'Handbrew',
                        'food' => 'Food',
                        'noncoffee' => 'Non-Coffee'
                    ])
                    ->required(),
                Grid::make(2)
                    ->schema([
                        Textarea::make('ingredients_en')
                            ->label('Ingredients (English)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('ingredients');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('ingredients') ?? [];
                                $viState = $get('ingredients_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('ingredients'),
                        Textarea::make('ingredients_vi')
                            ->label('Ingredients (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('ingredients');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                        Textarea::make('allergens_en')
                            ->label('Allergens (English)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('allergens');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'en');
                                    $component->state($value);
                                }
                            })
                            ->dehydrateStateUsing(function ($state, $get, $record) {
                                $currentTranslations = $record?->getTranslations('allergens') ?? [];
                                $viState = $get('allergens_vi');
                                
                                $result = HasTranslationFields::buildTranslationStructure($currentTranslations, 'en', $state);
                                if ($viState !== null) {
                                    $result = HasTranslationFields::buildTranslationStructure($result, 'vi', $viState);
                                }
                                return $result;
                            })
                            ->statePath('allergens'),
                        Textarea::make('allergens_vi')
                            ->label('Allergens (Vietnamese)')
                            ->afterStateHydrated(function (Textarea $component, $state, $record) {
                                if ($record) {
                                    $translations = $record->getTranslations('allergens');
                                    $value = HasTranslationFields::safeGetTranslation($translations, 'vi');
                                    $component->state($value);
                                }
                            }),
                    ]),
                Toggle::make('is_available')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
