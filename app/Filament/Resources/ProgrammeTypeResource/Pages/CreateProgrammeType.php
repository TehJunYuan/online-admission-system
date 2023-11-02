<?php

namespace App\Filament\Resources\ProgrammeTypeResource\Pages;

use App\Filament\Resources\ProgrammeTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgrammeType extends CreateRecord
{
    protected static string $resource = ProgrammeTypeResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
