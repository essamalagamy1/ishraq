<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesignRequestResource\Pages;
use App\Models\DesignRequest;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class DesignRequestResource extends Resource
{
    protected static ?string $model = DesignRequest::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'طلب تصميم';
    protected static ?string $pluralModelLabel = 'طلبات التصميم';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('full_name')->label('الاسم الكامل')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email()->required()->maxLength(255),
            Forms\Components\TextInput::make('phone')->label('رقم الهاتف')->tel()->required()->maxLength(255),
            Forms\Components\TextInput::make('company_name')->label('اسم الشركة')->maxLength(255),
            Forms\Components\Select::make('project_type')
                ->label('نوع المشروع')
                ->options([
                    'Excel' => 'Excel',
                    'Power BI' => 'Power BI',
                    'PowerPoint' => 'PowerPoint',
                    'Full analysis' => 'Full analysis',
                    'Other' => 'Other',
                ])
                ->required(),
            Forms\Components\TextInput::make('budget_range')->label('الميزانية'),
            Forms\Components\TextInput::make('deadline')->label('الموعد النهائي'),
            Forms\Components\Textarea::make('details')->label('التفاصيل')->required()->columnSpanFull(),
            Forms\Components\Select::make('status')
                ->label('الحالة')
                ->options([
                    'new' => 'جديد',
                    'in_progress' => 'قيد التنفيذ',
                    'closed' => 'مغلق',
                ])
                ->default('new')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('الاسم الكامل'),
                Tables\Columns\TextColumn::make('project_type')->label('نوع المشروع'),
                Tables\Columns\TextColumn::make('status')->label('الحالة')->badge()->color(fn (string $state): string => match ($state) {
                    'new' => 'primary',
                    'in_progress' => 'warning',
                    'closed' => 'success',
                }),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الطلب')->dateTime()->sortable(),
            ])
            ->actions([
                ViewAction::make(),
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
            'index'  => Pages\ListDesignRequests::route('/'),
            'create' => Pages\CreateDesignRequest::route('/create'),
            'view'   => Pages\ViewDesignRequest::route('/{record}'),
            'edit'   => Pages\EditDesignRequest::route('/{record}/edit'),
        ];
    }
}
