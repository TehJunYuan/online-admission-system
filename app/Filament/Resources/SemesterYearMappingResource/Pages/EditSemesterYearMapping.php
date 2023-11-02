<?php

namespace App\Filament\Resources\SemesterYearMappingResource\Pages;

use App\Filament\Resources\SemesterYearMappingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemesterYearMapping extends EditRecord
{
    protected static string $resource = SemesterYearMappingResource::class;

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
