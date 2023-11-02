<?php

namespace App\Filament\Resources\ApplicantProfileStatusResource\Pages;

use App\Filament\Resources\ApplicantProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicantProfileStatus extends EditRecord
{
    protected static string $resource = ApplicantProfileStatusResource::class;

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
