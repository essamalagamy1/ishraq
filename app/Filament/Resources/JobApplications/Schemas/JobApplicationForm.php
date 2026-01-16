<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class JobApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('years_of_experience')
                    ->label('سنوات الخبرة')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(50),

                Forms\Components\TextInput::make('specialization')
                    ->label('التخصص')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('cv_path')
                    ->label('السيرة الذاتية')
                    ->directory('cvs')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->maxSize(20480)
                    ->downloadable()
                    ->openable()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'قيد المراجعة',
                        'reviewed' => 'تمت المراجعة',
                        'accepted' => 'مقبول',
                        'rejected' => 'مرفوض',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\Textarea::make('notes')
                    ->label('ملاحظات')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
