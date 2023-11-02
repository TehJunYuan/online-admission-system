<?php

namespace App\Filament\Resources\ProgrammeTypeResource\Pages;

use App\Filament\Resources\ProgrammeTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgrammeType extends EditRecord
{
    protected static string $resource = ProgrammeTypeResource::class;

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
