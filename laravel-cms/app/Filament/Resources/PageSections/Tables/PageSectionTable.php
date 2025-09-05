<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PageSectionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section_name')
                    ->label('Section')
                    ->searchable(['section_key'])
                    ->sortable(['section_key']),

                ToggleColumn::make('is_visible')
                    ->label('Visible')
                    ->disabled(fn ($record) => $record->is_required),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_visible')
                    ->label('Visibility'),
            ])
            ->recordActions([])
            ->toolbarActions([])
            ->reorderable('sort_order')
            ->recordUrl(null);
    }
}