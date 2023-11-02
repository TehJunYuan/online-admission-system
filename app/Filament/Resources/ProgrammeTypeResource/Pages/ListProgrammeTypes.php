<?php

namespace App\Filament\Resources\ProgrammeTypeResource\Pages;

use App\Filament\Resources\ProgrammeTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammeTypes extends ListRecords
{
    protected static string $resource = ProgrammeTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
