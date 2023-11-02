<?php

namespace App\Filament\Resources\IdentityDocumentTypeResource\Pages;

use App\Filament\Resources\IdentityDocumentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIdentityDocumentType extends CreateRecord
{
    protected static string $resource = IdentityDocumentTypeResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
