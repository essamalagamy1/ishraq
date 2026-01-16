<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-share';
    protected static ?string $modelLabel = 'رابط تواصل';
    protected static ?string $pluralModelLabel = 'روابط التواصل';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('platform')
                ->label('المنصة')
                ->options([
                    'facebook' => 'Facebook',
                    'linkedin' => 'LinkedIn',
                    'x' => 'X (Twitter)',
                    'instagram' => 'Instagram',
                    'youtube' => 'YouTube',
                    'whatsapp' => 'WhatsApp',
                    'behance'=> 'Behance',
                    'other' => 'Other',
                ])
                ->required(),
            Forms\Components\TextInput::make('url')
                ->label('الرابط')
                ->url()
                ->required()
                ->maxLength(255),
            Forms\Components\Toggle::make('is_active')
                ->label('فعّال؟')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')->label('المنصة'),
                Tables\Columns\TextColumn::make('url')->label('الرابط'),
                Tables\Columns\IconColumn::make('is_active')->label('فعّال')->boolean(),
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
            'index'  => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit'   => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
