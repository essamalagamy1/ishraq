<?php

namespace App\Filament\Resources\ProjectTypes\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_ar')
                    ->label('الاسم بالعربية')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn ($set, ?string $state) => $set('slug', Str::slug($state)),
                    ),
                    
                TextInput::make('name_en')
                    ->label('الاسم بالإنجليزية')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('slug')
                    ->label('الرابط (Slug)')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('سيتم إنشاؤه تلقائياً من الاسم العربي')
                    ->columnSpanFull(),
                
                ColorPicker::make('color')
                    ->label('اللون')
                    ->required()
                    ->default('#3B82F6')
                    ->helperText('اللون المستخدم في عرض النوع'),
                
                TextInput::make('icon')
                    ->label('الأيقونة')
                    ->placeholder('fas fa-laptop-code')
                    ->helperText('أيقونة FontAwesome (اختياري)'),
                
                TextInput::make('order')
                    ->label('الترتيب')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('ترتيب العرض (الأقل أولاً)'),
                
                Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true)
                    ->helperText('إظهار/إخفاء هذا النوع في الموقع')
                    ->columnSpanFull(),
            ]);
    }
}

