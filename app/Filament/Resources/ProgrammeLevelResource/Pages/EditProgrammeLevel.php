<?php

namespace App\Filament\Resources\ProgrammeLevelResource\Pages;

use App\Filament\Resources\ProgrammeLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgrammeLevel extends EditRecord
{
    protected static string $resource = ProgrammeLevelResource::class;

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
