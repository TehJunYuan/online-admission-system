<?php

namespace App\Filament\Resources\IdentityDocumentTypeResource\Pages;

use App\Filament\Resources\IdentityDocumentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIdentityDocumentType extends EditRecord
{
    protected static string $resource = IdentityDocumentTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
