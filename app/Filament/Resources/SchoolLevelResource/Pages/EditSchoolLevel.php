<?php

namespace App\Filament\Resources\SchoolLevelResource\Pages;

use App\Filament\Resources\SchoolLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolLevel extends EditRecord
{
    protected static string $resource = SchoolLevelResource::class;

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
