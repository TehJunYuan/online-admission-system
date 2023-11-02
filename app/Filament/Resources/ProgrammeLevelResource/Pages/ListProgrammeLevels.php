<?php

namespace App\Filament\Resources\ProgrammeLevelResource\Pages;

use App\Filament\Resources\ProgrammeLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammeLevels extends ListRecords
{
    protected static string $resource = ProgrammeLevelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
