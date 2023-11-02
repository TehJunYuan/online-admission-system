<?php

namespace App\Filament\Resources\ChoicePriorityResource\Pages;

use App\Filament\Resources\ChoicePriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChoicePriorities extends ListRecords
{
    protected static string $resource = ChoicePriorityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
