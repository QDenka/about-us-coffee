<?php

namespace App\Filament\Resources\Workspaces\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorkspaceForm
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
                                Textarea::make('description_1.en')
                                    ->label('Description 1 (English)')
                                    ->required()
                                    ->columnSpanFull(),
                                Textarea::make('description_2.en')
                                    ->label('Description 2 (English)')
                                    ->columnSpanFull(),
                                Textarea::make('description_3.en')
                                    ->label('Description 3 (English)')
                                    ->columnSpanFull(),
                                Textarea::make('features.en')
                                    ->label('Features (English, comma-separated)')
                                    ->columnSpanFull(),
                                TextInput::make('ground_floor_title.en')
                                    ->label('Ground Floor Title (English)')
                                    ->columnSpanFull(),
                                TextInput::make('ground_floor_description.en')
                                    ->label('Ground Floor Description (English)')
                                    ->columnSpanFull(),
                                TextInput::make('second_floor_title.en')
                                    ->label('Second Floor Title (English)')
                                    ->columnSpanFull(),
                                TextInput::make('second_floor_description.en')
                                    ->label('Second Floor Description (English)')
                                    ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Vietnamese')
                    ->schema([
                                TextInput::make('title.vi')
                                    ->label('Title (Vietnamese)')
                                    ->columnSpanFull(),
                                Textarea::make('description_1.vi')
                                    ->label('Description 1 (Vietnamese)')
                                    ->columnSpanFull(),
                                Textarea::make('description_2.vi')
                                    ->label('Description 2 (Vietnamese)')
                                    ->columnSpanFull(),
                                Textarea::make('description_3.vi')
                                    ->label('Description 3 (Vietnamese)')
                                    ->columnSpanFull(),
                                Textarea::make('features.vi')
                                    ->label('Features (Vietnamese, comma-separated)')
                                    ->columnSpanFull(),
                                TextInput::make('ground_floor_title.vi')
                                    ->label('Ground Floor Title (Vietnamese)')
                                    ->columnSpanFull(),
                                TextInput::make('ground_floor_description.vi')
                                    ->label('Ground Floor Description (Vietnamese)')
                                    ->columnSpanFull(),
                                TextInput::make('second_floor_title.vi')
                                    ->label('Second Floor Title (Vietnamese)')
                                    ->columnSpanFull(),
                                TextInput::make('second_floor_description.vi')
                                    ->label('Second Floor Description (Vietnamese)')
                                    ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                
                Section::make('Floor Images')
                    ->schema([
                        FileUpload::make('ground_floor_image')
                            ->label('Ground Floor Image')
                            ->image()
                            ->disk('public')
                            ->directory('floor-images'),
                        FileUpload::make('second_floor_image')
                            ->label('Second Floor Image')
                            ->image()
                            ->disk('public')
                            ->directory('floor-images'),
                    ])
                    ->columns(2),
                    
                TextInput::make('wifi_speed')
                    ->label('WiFi Speed')
                    ->required()
                    ->default('300mbps'),
            ]);
    }
}
