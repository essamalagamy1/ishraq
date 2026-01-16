<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('section')
                    ->label('القسم')
                    ->required(),
                TextInput::make('icon')
                    ->label('الأيقونة')
                    ->required(),
                TextInput::make('title')
                    ->label('العنوان')
                    ->required(),
                Textarea::make('description')
                    ->label('الوصف')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('color_from')
                    ->label('اللون من')
                    ->required()
                    ->default('blue-500'),
                TextInput::make('color_to')
                    ->label('اللون إلى')
                    ->required()
                    ->default('cyan-500'),
                TextInput::make('badge_text')
                    ->label('نص الشارة'),
                TextInput::make('order')
                    ->label('الترتيب')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('نشط')
                    ->required(),
            ]);
    }
}
