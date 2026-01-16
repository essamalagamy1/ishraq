<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required(),
                TextInput::make('position')
                    ->label('المنصب')
                    ->required(),
                Textarea::make('bio')
                    ->label('السيرة الذاتية')
                    ->columnSpanFull(),
                TextInput::make('avatar')
                    ->label('الصورة الشخصية'),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email(),
                TextInput::make('phone')
                    ->label('الهاتف')
                    ->tel(),
                TextInput::make('linkedin')
                    ->label('لينكد إن'),
                TextInput::make('twitter')
                    ->label('تويتر'),
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
