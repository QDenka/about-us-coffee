<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Models\TeamMember;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;

    public function mount(string|int $record = null): void
    {
        $teamRecord = TeamMember::first();
        
        if (!$teamRecord) {
            $teamRecord = TeamMember::create([
                'name' => '',
                'title' => ['en' => '', 'vi' => ''],
                'bio' => ['en' => '', 'vi' => ''],
                'image' => null,
                'order' => 1,
                'is_active' => true,
            ]);
        }
        
        parent::mount($teamRecord->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
