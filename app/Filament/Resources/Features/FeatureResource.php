<?php

namespace App\Filament\Resources\Features;

use App\Filament\Resources\Features\Pages\CreateFeature;
use App\Filament\Resources\Features\Pages\EditFeature;
use App\Filament\Resources\Features\Pages\ListFeatures;
use App\Filament\Resources\Features\Schemas\FeatureForm;
use App\Filament\Resources\Features\Tables\FeaturesTable;
use App\Models\Feature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $navigationLabel = 'المميزات';
    
    protected static ?string $modelLabel = 'ميزة';
    
    protected static ?string $pluralModelLabel = 'المميزات';

    protected static ?string $recordTitleAttribute = 'title';
    
    protected static UnitEnum|string|null $navigationGroup = 'المحتوى';
    
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return FeatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeaturesTable::configure($table);
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
            'index' => ListFeatures::route('/'),
            'create' => CreateFeature::route('/create'),
            'edit' => EditFeature::route('/{record}/edit'),
        ];
    }
}
