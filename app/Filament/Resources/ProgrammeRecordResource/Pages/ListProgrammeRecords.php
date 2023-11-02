<?php

namespace App\Filament\Resources\ProgrammeRecordResource\Pages;

use App\Filament\Resources\ProgrammeRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammeRecords extends ListRecords
{
    protected static string $resource = ProgrammeRecordResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
