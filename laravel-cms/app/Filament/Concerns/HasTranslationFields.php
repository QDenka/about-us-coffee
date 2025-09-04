<?php

namespace App\Filament\Concerns;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

trait HasTranslationFields
{
    public static function safeGetTranslation($translations, $locale): string
    {
        if (!$translations) return '';
        
        if (is_array($translations)) {
            // Handle nested structure like {"vi":{"vi":"value"}}
            if (isset($translations[$locale]) && is_array($translations[$locale])) {
                return $translations[$locale][$locale] ?? '';
            }
            // Handle simple structure like {"vi":"value"}
            return $translations[$locale] ?? '';
        }
        
        return $translations ?? '';
    }

    public static function buildTranslationStructure($currentTranslations, $locale, $value): array
    {
        if (!is_array($currentTranslations)) {
            $currentTranslations = [];
        }

        // Ensure proper nested structure
        if (!isset($currentTranslations[$locale])) {
            $currentTranslations[$locale] = [];
        }
        
        if (!is_array($currentTranslations[$locale])) {
            $currentTranslations[$locale] = [$locale => $currentTranslations[$locale] ?? ''];
        }

        $currentTranslations[$locale][$locale] = $value;
        return $currentTranslations;
    }

    public static function makeTranslatableTextInput(string $field, string $locale, string $label, bool $required = false): TextInput
    {
        return TextInput::make("{$field}_{$locale}")
            ->label($label)
            ->required($required)
            ->afterStateHydrated(function (TextInput $component, $state, $record) use ($field, $locale) {
                if ($record) {
                    $translations = $record->getTranslations($field);
                    $value = static::safeGetTranslation($translations, $locale);
                    $component->state($value);
                }
            })
            ->dehydrateStateUsing(function ($state, $get, $record) use ($field, $locale) {
                $currentTranslations = $record?->getTranslations($field) ?? [];
                return static::buildTranslationStructure($currentTranslations, $locale, $state);
            });
    }

    public static function makeTranslatableTextarea(string $field, string $locale, string $label, bool $required = false): Textarea
    {
        return Textarea::make("{$field}_{$locale}")
            ->label($label)
            ->required($required)
            ->afterStateHydrated(function (Textarea $component, $state, $record) use ($field, $locale) {
                if ($record) {
                    $translations = $record->getTranslations($field);
                    $value = static::safeGetTranslation($translations, $locale);
                    $component->state($value);
                }
            })
            ->dehydrateStateUsing(function ($state, $get, $record) use ($field, $locale) {
                // Get current state of both locales
                $enState = $get("{$field}_en");
                $viState = $get("{$field}_vi");
                
                $currentTranslations = $record?->getTranslations($field) ?? [];
                
                // Build complete translation structure
                if ($enState !== null) {
                    $currentTranslations = static::buildTranslationStructure($currentTranslations, 'en', $enState);
                }
                if ($viState !== null) {
                    $currentTranslations = static::buildTranslationStructure($currentTranslations, 'vi', $viState);
                }
                
                return $currentTranslations;
            })
            ->live(false);
    }
}