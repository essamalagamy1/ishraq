<?php

namespace App\Filament\Resources\ProjectTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_ar')
                    ->label('الاسم بالعربية')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('name_en')
                    ->label('الاسم بالإنجليزية')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('slug')
                    ->label('الرابط')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                ColorColumn::make('color')
                    ->label('اللون'),
                
                TextColumn::make('icon')
                    ->label('الأيقونة')
                    ->toggleable(),
                
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                
                TextColumn::make('order')
                    ->label('الترتيب')
                    ->numeric()
                    ->sortable(),
                
                TextColumn::make('projects_count')
                    ->label('عدد المشاريع')
                    ->counts('projects')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('order')
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

