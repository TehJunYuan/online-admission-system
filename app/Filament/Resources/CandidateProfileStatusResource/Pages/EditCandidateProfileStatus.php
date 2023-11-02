<?php

namespace App\Filament\Resources\CandidateProfileStatusResource\Pages;

use App\Filament\Resources\CandidateProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandidateProfileStatus extends EditRecord
{
    protected static string $resource = CandidateProfileStatusResource::class;

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
