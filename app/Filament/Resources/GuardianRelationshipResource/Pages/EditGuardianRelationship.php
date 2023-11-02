<?php

namespace App\Filament\Resources\GuardianRelationshipResource\Pages;

use App\Filament\Resources\GuardianRelationshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuardianRelationship extends EditRecord
{
    protected static string $resource = GuardianRelationshipResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
