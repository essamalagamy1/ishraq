<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SEOSettingsResource\Pages;
use App\Models\SeoSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SEOSettingsResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?string $modelLabel = 'إعداد SEO';
    protected static ?string $pluralModelLabel = 'إعدادات SEO';
    protected static string|\UnitEnum|null $navigationGroup = 'الإعدادات';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // Page Selection
            Forms\Components\Select::make('page')
                ->label('الصفحة')
                ->options([
                    'home' => 'الرئيسية',
                    'about' => 'من نحن',
                    'services' => 'الخدمات',
                    'portfolio' => 'المعرض',
                    'contact' => 'تواصل معنا',
                    'request_design' => 'طلب تصميم',
                ])
                ->required()
                ->unique(ignoreRecord: true)
                ->columnSpanFull(),
            
            // Basic SEO
            Forms\Components\TextInput::make('meta_title')
                ->label('عنوان الصفحة (Meta Title)')
                ->required()
                ->maxLength(60)
                ->helperText('الحد الأقصى: 60 حرف'),
            
            Forms\Components\Textarea::make('meta_description')
                ->label('وصف الصفحة (Meta Description)')
                ->required()
                ->maxLength(160)
                ->rows(3)
                ->helperText('الحد الأقصى: 160 حرف')
                ->columnSpanFull(),
            
            Forms\Components\TagsInput::make('meta_keywords')
                ->label('الكلمات المفتاحية')
                ->placeholder('أضف كلمة مفتاحية')
                ->separator(',')
                ->columnSpanFull(),
            
            Forms\Components\TextInput::make('canonical_url')
                ->label('الرابط الأساسي (Canonical URL)')
                ->url()
                ->placeholder('https://example.com/page'),
            
            Forms\Components\Select::make('robots')
                ->label('تعليمات محركات البحث')
                ->options([
                    'index,follow' => 'فهرسة ومتابعة',
                    'noindex,follow' => 'عدم الفهرسة',
                    'index,nofollow' => 'فهرسة بدون متابعة',
                    'noindex,nofollow' => 'عدم الفهرسة والمتابعة',
                ])
                ->default('index,follow')
                ->required(),
            
            Forms\Components\Toggle::make('is_active')
                ->label('نشط')
                ->default(true),

            // Open Graph
            Forms\Components\TextInput::make('og_title')
                ->label('عنوان Open Graph')
                ->maxLength(60)
                ->helperText('للمشاركة على وسائل التواصل'),
            
            Forms\Components\Textarea::make('og_description')
                ->label('وصف Open Graph')
                ->maxLength(160)
                ->rows(2)
                ->columnSpanFull(),
            
            Forms\Components\FileUpload::make('og_image')
                ->label('صورة Open Graph')
                ->image()
                ->directory('seo/og-images')
                ->helperText('1200x630 بكسل'),
            
            Forms\Components\Select::make('og_type')
                ->label('نوع المحتوى')
                ->options([
                    'website' => 'موقع ويب',
                    'article' => 'مقالة',
                    'product' => 'منتج',
                ])
                ->default('website'),

            // Twitter
            Forms\Components\Select::make('twitter_card')
                ->label('نوع بطاقة Twitter')
                ->options([
                    'summary' => 'ملخص',
                    'summary_large_image' => 'ملخص مع صورة كبيرة',
                ])
                ->default('summary_large_image'),
            
            Forms\Components\TextInput::make('twitter_site')
                ->label('حساب Twitter')
                ->placeholder('@username'),

            // Analytics
            Forms\Components\TextInput::make('ga4_measurement_id')
                ->label('Google Analytics 4 ID')
                ->placeholder('G-XXXXXXXXXX'),
            
            Forms\Components\TextInput::make('gsc_verification_code')
                ->label('Google Search Console Code')
                ->placeholder('google123...'),
            
            Forms\Components\TextInput::make('gtm_container_id')
                ->label('Google Tag Manager ID')
                ->placeholder('GTM-XXXXXXX'),

            // Structured Data
            Forms\Components\Textarea::make('structured_data')
                ->label('بيانات منظمة (JSON)')
                ->rows(8)
                ->placeholder('{"@context": "https://schema.org", ...}')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->label('الصفحة')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->label('عنوان Meta')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('robots')
                    ->label('Robots')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'index,follow' => 'success',
                        'noindex,nofollow' => 'danger',
                        default => 'warning',
                    }),
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
            'index'  => Pages\ListSEOSettings::route('/'),
            'create' => Pages\CreateSEOSettings::route('/create'),
            'edit'   => Pages\EditSEOSettings::route('/{record}/edit'),
        ];
    }
}
