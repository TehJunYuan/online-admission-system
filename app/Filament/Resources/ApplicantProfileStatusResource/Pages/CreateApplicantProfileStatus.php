<?php

namespace App\Filament\Resources\ApplicantProfileStatusResource\Pages;

use App\Filament\Resources\ApplicantProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApplicantProfileStatus extends CreateRecord
{
    protected static string $resource = ApplicantProfileStatusResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
