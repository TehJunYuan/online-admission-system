<?php

namespace App\Filament\Resources\ApplicantProfileStatusResource\Pages;

use App\Filament\Resources\ApplicantProfileStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicantProfileStatuses extends ListRecords
{
    protected static string $resource = ApplicantProfileStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
