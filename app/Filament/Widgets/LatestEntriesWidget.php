<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\DesignRequest;
use App\Models\Testimonial;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEntriesWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->heading('آخر الإدخالات')
            ->query(
                ContactMessage::query()->latest()->limit(10)
            )
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),
                TextColumn::make('subject')
                    ->label('الموضوع')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->colors([
                        'danger' => 'unread',
                        'success' => 'read',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'unread' => 'غير مقروء',
                        'read' => 'مقروء',
                        default => $state,
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
