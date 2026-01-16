<?php

namespace App\Filament\Resources\DesignRequestResource\Pages;

use App\Filament\Resources\DesignRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignRequests extends ListRecords
{
    protected static string $resource = DesignRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
