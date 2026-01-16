<?php

namespace App\Filament\Resources\AnalyticsSettings;

use App\Filament\Resources\AnalyticsSettings\Pages\CreateAnalyticsSetting;
use App\Filament\Resources\AnalyticsSettings\Pages\EditAnalyticsSetting;
use App\Filament\Resources\AnalyticsSettings\Pages\ListAnalyticsSettings;
use App\Filament\Resources\AnalyticsSettings\Schemas\AnalyticsSettingForm;
use App\Filament\Resources\AnalyticsSettings\Tables\AnalyticsSettingsTable;
use App\Models\AnalyticsSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnalyticsSettingResource extends Resource
{
    protected static ?string $model = AnalyticsSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    
    protected static ?string $modelLabel = 'إعدادات التحليلات';
    protected static ?string $pluralModelLabel = 'إعدادات التحليلات';
    protected static string|\UnitEnum|null $navigationGroup = 'الإعدادات';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return AnalyticsSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnalyticsSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnalyticsSettings::route('/'),
            'create' => CreateAnalyticsSetting::route('/create'),
            'edit' => EditAnalyticsSetting::route('/{record}/edit'),
        ];
    }
}
