<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'مشروع';
    protected static ?string $pluralModelLabel = 'المشاريع';
    protected static string|\UnitEnum|null $navigationGroup = 'المشاريع';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->label('عنوان المشروع')
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
            Forms\Components\FileUpload::make('main_image')
                ->label('الصورة الرئيسية')
                ->image()
                ->directory('projects')
                ->required(),
            Forms\Components\FileUpload::make('video_url')
                ->label('رابط الفيديو (اختياري)')
                ->disk('public')
                ->directory('projects/videos')
                ->visibility('public')
                ->maxSize(102400)
                ->acceptedFileTypes(['video/*'])
                ->downloadable()
                ->openable()
                ->helperText('الحد الأقصى: 100 ميجابايت'),
            Forms\Components\Toggle::make('is_featured')
                ->label('عرض في الصفحة الرئيسية؟'),
            Forms\Components\Select::make('types')
                ->label('أنواع المشروع')
                ->multiple()
                ->relationship('types', 'name_ar')
                ->preload()
                ->searchable()
                ->helperText('يمكن اختيار أكثر من نوع'),
            Forms\Components\Toggle::make('is_available_for_purchase')
                ->label('متاح للشراء')
                ->live()
                ->helperText('هل هذا المشروع متاح للبيع؟'),
            Forms\Components\TextInput::make('price')
                ->label('السعر')
                ->numeric()
                ->prefix('ر.س')
                ->visible(fn ($get) => $get('is_available_for_purchase'))
                ->helperText('سعر المشروع بالريال السعودي'),
            Forms\Components\Select::make('status')
                ->label('الحالة')
                ->options([
                    'draft' => 'مسودة',
                    'published' => 'منشور',
                ])
                ->default('published')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('العنوان'),
                Tables\Columns\IconColumn::make('is_featured')->label('مميز')->boolean(),
                Tables\Columns\TextColumn::make('status')->label('الحالة'),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProjectImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
