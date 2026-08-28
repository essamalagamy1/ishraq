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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
            Forms\Components\TextInput::make('project_url')
                ->label('رابط المشروع / المعاينة المباشرة')
                ->url()
                ->placeholder('https://example.com')
                ->maxLength(500)
                ->helperText('رابط الموقع الحي أو رابط معاينة وتجربة المشروع (اختياري)'),
            Forms\Components\Repeater::make('projectImages')
                ->relationship('projectImages')
                ->label('صور إضافية للمشروع (المعرض)')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('الصورة')
                        ->image()
                        ->directory('project-gallery')
                        ->live()
                        ->afterStateUpdated(function ($state, $set, $get) {
                            $file = is_array($state) ? (reset($state) ?: null) : $state;
                            if ($file instanceof TemporaryUploadedFile) {
                                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                                $set('caption', $filename);
                            }
                        })
                        ->required(),
                    Forms\Components\TextInput::make('caption')
                        ->label('التعليق')
                        ->maxLength(255)
                        ->helperText('يتم تعيين اسم الملف تلقائياً كتعليق، ويمكنك تعديله بحرية'),
                    Forms\Components\TextInput::make('order')
                        ->label('الترتيب')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(3)
                ->collapsible()
                ->defaultItems(0)
                ->addActionLabel('إضافة صورة جديدة')
                ->columnSpanFull(),
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
                ->helperText('هل هذا المشروع معروض للبيع؟'),
            Forms\Components\TextInput::make('price')
                ->label('السعر (بالريال السعودي)')
                ->numeric()
                ->prefix('ر.س')
                ->visible(fn ($get) => (bool) $get('is_available_for_purchase'))
                ->helperText('سعر شراء المشروع بالريال السعودي'),
            Forms\Components\RichEditor::make('purchase_includes')
                ->label('ما يُقدَّم مع الشراء (المشمولات والتسليمات)')
                ->placeholder("اكتب كل ما سيحصل عليه المشتري، مثل:\n• ملفات التصميم الأصلية (Figma / PSD / AI)\n• الكود المصدري الكامل مع التوثيق البرمجي\n• رخصة الاستخدام التجاري الحصري\n• دعم فني مجاني لمدة 3 أشهر")
                ->helperText('سيتم عرض هذه المشمولات والتسليمات في صفحة تفاصيل المشروع لتعريف المشتري بما يحصل عليه.')
                ->visible(fn ($get) => (bool) $get('is_available_for_purchase'))
                ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('project_url')
                    ->label('رابط المشروع')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn ($record) => $record->project_url, true)
                    ->openUrlInNewTab()
                    ->placeholder('—')
                    ->toggleable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
