<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->label('اسم العميل')
                    ->required(),
                TextInput::make('client_position')
                    ->label('منصب العميل')
                    ->required(),
                TextInput::make('client_company')
                    ->label('شركة العميل'),
                TextInput::make('client_avatar')
                    ->label('صورة العميل'),
                TextInput::make('rating')
                    ->label('التقييم')
                    ->required()
                    ->numeric()
                    ->default(5),
                Textarea::make('testimonial')
                    ->label('الشهادة')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('badge_text')
                    ->label('نص الشارة'),
                TextInput::make('badge_color_from')
                    ->label('لون الشارة من')
                    ->required()
                    ->default('blue-600'),
                TextInput::make('badge_color_to')
                    ->label('لون الشارة إلى')
                    ->required()
                    ->default('cyan-500'),
                Toggle::make('is_verified')
                    ->label('موثق')
                    ->required(),
                Toggle::make('is_featured')
                    ->label('مميز')
                    ->required(),
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
