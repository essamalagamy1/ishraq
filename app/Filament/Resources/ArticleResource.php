<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'مقال';

    protected static ?string $pluralModelLabel = 'المقالات';

    protected static string|\UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->label('عنوان المقال')
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
            Forms\Components\Textarea::make('excerpt')
                ->label('ملخص المقال')
                ->rows(3)
                ->columnSpanFull()
                ->helperText('ملخص قصير يظهر في قائمة المقالات'),
            Forms\Components\RichEditor::make('content')
                ->label('محتوى المقال')
                ->required()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('featured_image')
                ->label('الصورة الرئيسية')
                ->image()
                ->directory('articles')
                ->imageEditor(),
            Forms\Components\TextInput::make('author')
                ->label('اسم الكاتب')
                ->maxLength(255),
            Forms\Components\Toggle::make('is_published')
                ->label('منشور')
                ->helperText('هل المقال منشور ومتاح للعامة؟'),
            Forms\Components\Toggle::make('is_featured')
                ->label('مميز')
                ->helperText('عرض في القسم المميز'),
            Forms\Components\DateTimePicker::make('published_at')
                ->label('تاريخ النشر')
                ->default(now()),
            Forms\Components\TextInput::make('meta_title')
                ->label('عنوان SEO')
                ->maxLength(255)
                ->helperText('اتركه فارغاً لاستخدام عنوان المقال'),
            Forms\Components\Textarea::make('meta_description')
                ->label('وصف SEO')
                ->rows(2)
                ->maxLength(160)
                ->helperText('اتركه فارغاً لاستخدام ملخص المقال'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('الصورة')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('الكاتب')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('منشور')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('المشاهدات')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('حالة النشر'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('المميز'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
