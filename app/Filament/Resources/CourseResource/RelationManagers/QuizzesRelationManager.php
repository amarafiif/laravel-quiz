<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizzesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';
    protected static ?string $recordTitleAttribute = 'Quiz';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informasi Kuis')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kuis')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Kuis')
                            ->required()
                    ])->columns(1),
                Fieldset::make('Waktu Kuis')
                    ->schema([
                        Forms\Components\TimePicker::make('attempt_time')
                            ->label('Waktu Pengerjaan')
                            ->required(),
                        Forms\Components\DateTimePicker::make('deadline')
                            ->label('Batas Akhir Pengerjaan')
                            ->displayFormat('d-F-Y')
                            ->required(),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail Course')
                            ->image()
                            ->directory('quizzes-thumb')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->required()
                            ->columnSpanFull()
                    ]),
                Fieldset::make('Pengaturan Kuis')
                    ->schema([
                        Forms\Components\Toggle::make('is_allowed_repeat')
                            ->label('Izinkan Mengulang Kuis')
                            ->live()
                            ->required(),
                        Forms\Components\TextInput::make('many_attempt')
                            ->label('Banyak Pengulangan')
                            ->numeric()
                            ->visible(fn(Get $get): bool => $get('is_allowed_repeat'))
                    ])
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kuis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attempt_time')
                    ->label('Waktu Pengerjaan')
                    ->badge(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Berakhir Pada')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\ToggleColumn::make('is_allowed_repeat')
                    ->label('Izinkan Mengulang'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Kuis Baru')
                    ->icon('heroicon-o-document-arrow-up'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
