<?php

namespace App\Filament\Resources\ServiceFeatures\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceFeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->label('الخدمة')
                    ->relationship('service', 'title')
                    ->required(),
                TextInput::make('feature_text')
                    ->label('نص الميزة')
                    ->required(),
                TextInput::make('icon')
                    ->label('الأيقونة'),
                TextInput::make('order')
                    ->label('الترتيب')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
