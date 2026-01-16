<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySettingsResource\Pages;
use App\Models\CompanySetting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class CompanySettingsResource extends Resource
{
    protected static ?string $model = CompanySetting::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $modelLabel = 'إعدادات الشركة';

    protected static ?string $pluralModelLabel = 'إعدادات الشركة';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // معلومات الشركة
            Forms\Components\TextInput::make('company_name')->label('اسم الشركة')->required()->maxLength(255),
            Forms\Components\TextInput::make('main_email')->label('البريد الرئيسي')->email()->required()->maxLength(255),
            Forms\Components\TextInput::make('secondary_email')->label('بريد بديل')->email()->maxLength(255),
            Forms\Components\TextInput::make('phone_primary')->label('الهاتف الرئيسي')->tel()->maxLength(255),
            Forms\Components\TextInput::make('phone_secondary')->label('هاتف بديل')->tel()->maxLength(255),
            Forms\Components\TextInput::make('whatsapp_number')->label('واتساب')->tel()->maxLength(255),
            Forms\Components\TextInput::make('location_text')->label('الموقع')->maxLength(255),
            Forms\Components\Textarea::make('about_short')->label('وصف مختصر')->columnSpanFull(),

            // الشعارات
            Forms\Components\FileUpload::make('logo_path')->label('شعار الشركة')->image()->directory('logos'),
            Forms\Components\FileUpload::make('favicon_path')->label('فافيكون')->image()->directory('logos'),
            Forms\Components\FileUpload::make('logo_2_path')->label('شعار 2')->image()->directory('logos'),

            // الشروط والأحكام
            Forms\Components\RichEditor::make('terms_conditions')
                ->label('الشروط والأحكام')
                ->columnSpanFull(),

            // سياسة الخصوصية
            Forms\Components\RichEditor::make('privacy_policy')
                ->label('سياسة الخصوصية')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->label('اسم الشركة'),
                Tables\Columns\TextColumn::make('main_email')->label('البريد'),
                Tables\Columns\TextColumn::make('phone_primary')->label('الهاتف'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanySettings::route('/'),
            'edit' => Pages\EditCompanySettings::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
