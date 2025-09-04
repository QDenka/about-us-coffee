<?php

namespace App\Filament\Resources\Workspaces\Pages;

use App\Filament\Resources\Workspaces\WorkspaceResource;
use App\Models\Workspace;
use Filament\Resources\Pages\EditRecord;

class EditWorkspace extends EditRecord
{
    protected static string $resource = WorkspaceResource::class;

    public function mount(string|int $record = null): void
    {
        $workspaceRecord = Workspace::first();
        
        if (!$workspaceRecord) {
            $workspaceRecord = Workspace::create([
                'title' => ['en' => '', 'vi' => ''],
                'description_1' => ['en' => '', 'vi' => ''],
                'description_2' => ['en' => '', 'vi' => ''],
                'description_3' => ['en' => '', 'vi' => ''],
                'features' => ['en' => [], 'vi' => []],
                'ground_floor_title' => ['en' => '', 'vi' => ''],
                'ground_floor_description' => ['en' => '', 'vi' => ''],
                'second_floor_title' => ['en' => '', 'vi' => ''],
                'second_floor_description' => ['en' => '', 'vi' => ''],
                'wifi_speed' => '',
            ]);
        }
        
        parent::mount($workspaceRecord->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
