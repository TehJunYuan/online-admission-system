<?php

namespace App\Filament\Resources\IdentityDocumentTypeResource\Pages;

use App\Filament\Resources\IdentityDocumentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIdentityDocumentTypes extends ListRecords
{
    protected static string $resource = IdentityDocumentTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
