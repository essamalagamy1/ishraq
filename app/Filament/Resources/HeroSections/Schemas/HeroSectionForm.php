<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page')
                    ->label('الصفحة')
                    ->required(),
                TextInput::make('badge_icon')
                    ->label('أيقونة الشارة'),
                TextInput::make('badge_text')
                    ->label('نص الشارة'),
                TextInput::make('title_line1')
                    ->label('السطر الأول من العنوان')
                    ->required(),
                TextInput::make('title_line2')
                    ->label('السطر الثاني من العنوان')
                    ->required(),
                Textarea::make('subtitle')
                    ->label('العنوان الفرعي')
                    ->columnSpanFull(),
                TextInput::make('cta_primary_text')
                    ->label('نص الزر الأساسي'),
                TextInput::make('cta_primary_link')
                    ->label('رابط الزر الأساسي'),
                TextInput::make('cta_secondary_text')
                    ->label('نص الزر الثانوي'),
                TextInput::make('cta_secondary_link')
                    ->label('رابط الزر الثانوي'),
                FileUpload::make('background_image')
                    ->label('صورة الخلفية')
                    ->image(),
                Toggle::make('is_active')
                    ->label('مفعّل')
                    ->required(),
            ]);
    }
}
