<?php

namespace App\Filament\Resources\Stats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page')
                    ->label('الصفحة')
                    ->required(),
                TextInput::make('icon')
                    ->label('الأيقونة')
                    ->required(),
                TextInput::make('number')
                    ->label('الرقم')
                    ->required(),
                TextInput::make('label')
                    ->label('العنوان')
                    ->required(),
                TextInput::make('description')
                    ->label('الوصف'),
                TextInput::make('color_from')
                    ->label('اللون من')
                    ->required()
                    ->default('blue-400'),
                TextInput::make('color_to')
                    ->label('اللون إلى')
                    ->required()
                    ->default('cyan-400'),
                TextInput::make('order')
                    ->label('الترتيب')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('مفعّل')
                    ->required(),
            ]);
    }
}
