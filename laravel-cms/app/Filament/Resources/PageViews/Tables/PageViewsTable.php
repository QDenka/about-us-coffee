<?php

namespace App\Filament\Resources\PageViews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageViewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_title')
                    ->label('Tiêu đề trang')
                    ->formatStateUsing(fn ($state, $record) => $state ?: parse_url($record->url, PHP_URL_PATH))
                    ->searchable()
                    ->wrap(),
                    
                TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->url),
                    
                TextColumn::make('ip_address')
                    ->label('Địa chỉ IP')
                    ->searchable()
                    ->toggleable(),
                    
                TextColumn::make('referer')
                    ->label('Nguồn giới thiệu')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->referer)
                    ->toggleable(),
                    
                TextColumn::make('user_agent')
                    ->label('Thiết bị')
                    ->formatStateUsing(function ($state) {
                        if (str_contains($state, 'Mobile')) {
                            return '📱 Di động';
                        } elseif (str_contains($state, 'Tablet')) {
                            return '📋 Máy tính bảng';
                        } else {
                            return '💻 Máy tính để bàn';
                        }
                    })
                    ->toggleable(),
                    
                TextColumn::make('viewed_at')
                    ->label('Thời gian xem')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
            ])
            ->defaultSort('viewed_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
