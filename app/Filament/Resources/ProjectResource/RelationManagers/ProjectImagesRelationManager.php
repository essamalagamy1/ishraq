<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'projectImages';
    protected static ?string $modelLabel = 'صورة مشروع';
    protected static ?string $pluralModelLabel = 'صور المشروع';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\FileUpload::make('image_path')
                ->label('الصورة')
                ->image()
                ->directory('project-gallery')
                ->required(),
            Forms\Components\TextInput::make('caption')
                ->label('تعليق')
                ->maxLength(255),
            Forms\Components\TextInput::make('order')
                ->label('الترتيب')
                ->numeric(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('الصورة'),
                Tables\Columns\TextColumn::make('caption')->label('التعليق'),
                Tables\Columns\TextColumn::make('order')->label('الترتيب')->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
