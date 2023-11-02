<?php

namespace App\Filament\Resources\SemesterYearMappingResource\Pages;

use App\Filament\Resources\SemesterYearMappingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSemesterYearMappings extends ListRecords
{
    protected static string $resource = SemesterYearMappingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
