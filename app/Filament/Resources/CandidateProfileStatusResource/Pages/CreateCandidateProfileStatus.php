<?php

namespace App\Filament\Resources\CandidateProfileStatusResource\Pages;

use App\Filament\Resources\CandidateProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCandidateProfileStatus extends CreateRecord
{
    protected static string $resource = CandidateProfileStatusResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
