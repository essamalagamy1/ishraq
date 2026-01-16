<?php

namespace App\Filament\Resources\AnalyticsSettings\Pages;

use App\Filament\Resources\AnalyticsSettings\AnalyticsSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnalyticsSetting extends EditRecord
{
    protected static string $resource = AnalyticsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
