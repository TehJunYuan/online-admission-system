<?php

namespace App\Filament\Resources\ProgrammeLevelResource\Pages;

use App\Filament\Resources\ProgrammeLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgrammeLevel extends CreateRecord
{
    protected static string $resource = ProgrammeLevelResource::class;
    
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

}
