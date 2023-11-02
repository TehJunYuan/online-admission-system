<?php

namespace App\Filament\Resources\ChoicePriorityResource\Pages;

use App\Filament\Resources\ChoicePriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChoicePriority extends CreateRecord
{
    protected static string $resource = ChoicePriorityResource::class;
    
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
