<?php

namespace App\Filament\Resources\ChoicePriorityResource\Pages;

use App\Filament\Resources\ChoicePriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChoicePriority extends EditRecord
{
    protected static string $resource = ChoicePriorityResource::class;

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
