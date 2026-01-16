<?php

namespace App\Filament\Resources\AnalyticsSettings\Pages;

use App\Filament\Resources\AnalyticsSettings\AnalyticsSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnalyticsSettings extends ListRecords
{
    protected static string $resource = AnalyticsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
