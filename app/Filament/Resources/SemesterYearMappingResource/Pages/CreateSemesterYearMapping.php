<?php

namespace App\Filament\Resources\SemesterYearMappingResource\Pages;

use App\Filament\Resources\SemesterYearMappingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSemesterYearMapping extends CreateRecord
{
    protected static string $resource = SemesterYearMappingResource::class;
    
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
