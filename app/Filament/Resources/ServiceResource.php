<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog';
    
    protected static ?string $navigationLabel = 'الخدمات';
    
    protected static ?string $modelLabel = 'خدمة';
    
    protected static ?string $pluralModelLabel = 'الخدمات';
    
    protected static ?string $recordTitleAttribute = 'title';
    
    protected static UnitEnum|string|null $navigationGroup = 'الخدمات';
    
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->label('عنوان الخدمة')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
	            ->afterStateUpdated(
		            fn ($set, ?string $state) => $set('slug', Str::slug($state)),
	            ),
            Forms\Components\TextInput::make('slug')
                ->label('الرابط (Slug)')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('short_description')
                ->label('وصف مختصر')
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('description')
                ->label('الوصف الكامل')
                ->required()
                ->columnSpanFull(),
            Forms\Components\TextInput::make('icon')
                ->label('أيقونة (Heroicon)'),
            Forms\Components\TextInput::make('duration')
                ->label('المدة'),
            Forms\Components\Toggle::make('is_active')
                ->label('فعّالة؟')
                ->default(true),
                
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('العنوان'),
                Tables\Columns\IconColumn::make('is_active')->label('فعّالة')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime()->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
