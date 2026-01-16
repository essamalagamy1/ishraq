<?php

namespace App\Filament\Resources\DesignRequestResource\Pages;

use App\Filament\Resources\DesignRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesignRequest extends EditRecord
{
    protected static string $resource = DesignRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
