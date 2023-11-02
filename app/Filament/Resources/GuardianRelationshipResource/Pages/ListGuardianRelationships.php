<?php

namespace App\Filament\Resources\GuardianRelationshipResource\Pages;

use App\Filament\Resources\GuardianRelationshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuardianRelationships extends ListRecords
{
    protected static string $resource = GuardianRelationshipResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
