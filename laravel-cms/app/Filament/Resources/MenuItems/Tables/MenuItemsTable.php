<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->formatStateUsing(function ($record) {
                        $translations = $record->getTranslations('name');
                        $enName = is_array($translations) && isset($translations['en']) 
                            ? (is_array($translations['en']) ? ($translations['en']['en'] ?? '') : $translations['en'])
                            : '';
                        $viName = is_array($translations) && isset($translations['vi'])
                            ? (is_array($translations['vi']) ? ($translations['vi']['vi'] ?? '') : $translations['vi'])
                            : '';
                        return $enName . ($viName ? ' / ' . $viName : '');
                    })
                    ->searchable(),
                TextColumn::make('price')
                    ->money('VND')
                    ->sortable(),
                ImageColumn::make('image')
                    ->url(fn ($record) => $record->image ? asset('storage/' . $record->image) : null),
                TextColumn::make('category')
                    ->searchable(),
                IconColumn::make('is_available')
                    ->boolean(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
