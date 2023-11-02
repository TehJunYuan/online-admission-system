<?php

namespace App\Filament\Resources\MaritalResource\Pages;

use App\Filament\Resources\MaritalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaritals extends ListRecords
{
    protected static string $resource = MaritalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
