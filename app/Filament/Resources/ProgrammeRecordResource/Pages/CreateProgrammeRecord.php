<?php

namespace App\Filament\Resources\ProgrammeRecordResource\Pages;

use App\Filament\Resources\ProgrammeRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgrammeRecord extends CreateRecord
{
    protected static string $resource = ProgrammeRecordResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

}
