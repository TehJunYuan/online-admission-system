<?php

namespace App\Filament\Resources\CandidateProfileStatusResource\Pages;

use App\Filament\Resources\CandidateProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCandidateProfileStatuses extends ListRecords
{
    protected static string $resource = CandidateProfileStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
