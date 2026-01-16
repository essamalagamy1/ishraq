<?php

namespace App\Filament\Resources\PageContents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page')
                    ->label('الصفحة')
                    ->required(),
                TextInput::make('section')
                    ->label('القسم')
                    ->required(),
                TextInput::make('key')
                    ->label('المفتاح')
                    ->required(),
                Textarea::make('value')
                    ->label('القيمة')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->label('النوع')
                    ->required()
                    ->default('text'),
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
