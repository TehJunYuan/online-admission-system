<?php

namespace App\Filament\Resources\NationalityResource\Pages;

use App\Filament\Resources\NationalityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNationalities extends ListRecords
{
    protected static string $resource = NationalityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
