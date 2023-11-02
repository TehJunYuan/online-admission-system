<?php

namespace App\Filament\Resources\SchoolLevelResource\Pages;

use App\Filament\Resources\SchoolLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolLevels extends ListRecords
{
    protected static string $resource = SchoolLevelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
