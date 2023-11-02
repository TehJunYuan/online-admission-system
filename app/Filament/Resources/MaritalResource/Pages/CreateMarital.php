<?php

namespace App\Filament\Resources\MaritalResource\Pages;

use App\Filament\Resources\MaritalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarital extends CreateRecord
{
    protected static string $resource = MaritalResource::class;

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
