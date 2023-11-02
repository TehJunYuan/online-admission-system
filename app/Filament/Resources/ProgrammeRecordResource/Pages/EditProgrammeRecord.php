<?php

namespace App\Filament\Resources\ProgrammeRecordResource\Pages;

use App\Filament\Resources\ProgrammeRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgrammeRecord extends EditRecord
{
    protected static string $resource = ProgrammeRecordResource::class;

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
