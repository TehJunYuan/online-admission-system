<?php

namespace App\Filament\Resources\MaritalResource\Pages;

use App\Filament\Resources\MaritalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarital extends EditRecord
{
    protected static string $resource = MaritalResource::class;

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
