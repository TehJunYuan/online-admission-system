<?php

namespace App\Filament\Resources\GuardianRelationshipResource\Pages;

use App\Filament\Resources\GuardianRelationshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuardianRelationship extends CreateRecord
{
    protected static string $resource = GuardianRelationshipResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
