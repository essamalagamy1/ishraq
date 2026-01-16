<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client_name')
                    ->label('اسم العميل')
                    ->searchable(),
                TextColumn::make('client_position')
                    ->label('المنصب')
                    ->searchable(),
                TextColumn::make('client_company')
                    ->label('الشركة')
                    ->searchable(),
                TextColumn::make('testimonial')
                    ->label('التقييم')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('التقييم بالنجوم')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('badge_text')
                    ->label('نص الشارة')
                    ->searchable(),
                IconColumn::make('is_verified')
                    ->label('موثق')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                TextColumn::make('order')
                    ->label('الترتيب')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('تاريخ التحديث')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
