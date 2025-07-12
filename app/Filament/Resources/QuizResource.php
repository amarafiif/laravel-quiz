<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Quiz Information')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kuis')
                            ->required(),
                        MarkdownEditor::make('description')
                            ->label('Deskripsi')
                            ->maxLength(500)
                            ->required()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'heading',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                            ]),
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->directory('quizzes/thumbnails')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file, $get): string => 'thumb-'.str($get('name') ?? '')
                                    ->slug().'-'.($get('code') ?? '').'.'.$file->getClientOriginalExtension()
                            )
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->hint(new HtmlString(
                                '1920x1080 piksel. Ukuran file maksimal 2MB.'
                            ))
                            ->hintColor('warning')
                            ->optimize('webp')
                            ->required(),
                    ]),

                Section::make('Quiz Settings')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TimePicker::make('attempt_time')
                                    ->label('Batas Waktu')
                                    ->required()
                                    ->helperText('Lama waktu pengerjaan untuk setiap percobaan kuis.')
                                    ->default(now()->addMinutes(30)),
                                DateTimePicker::make('deadline')
                                    ->label('Batas Akhir')
                                    ->required()
                                    ->native(false)
                                    ->seconds(false)
                                    ->helperText('Batas waktu terakhir untuk mengerjakan kuis.')
                                    ->default(now()->addDays(7)),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_allowed_repeat')
                                    ->label('Izinkan Pengulangan')
                                    ->inline(false)
                                    ->helperText('Jika diaktifkan, pengguna dapat mengulangi kuis beberapa kali.')
                                    ->default(false)
                                    ->live(),
                                TextInput::make('many_attempt')
                                    ->label('Batas Pengulangan')
                                    ->numeric()
                                    ->default(1)
                                    ->required(fn ($get) => $get('is_allowed_repeat') === true)
                                    ->helperText('Atur jumlah pengulangan yang diizinkan. Kosongkan untuk tidak ada batasan.')
                                    ->visible(fn ($get) => $get('is_allowed_repeat') === true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('course.name')
                    ->label('Nama Kursus')
                    ->limit(20)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->label('Nama Kuis')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_questions')
                    ->label('Soal')
                    ->alignCenter()
                    ->badge()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('attempt_time')
                    ->label('Batas Waktu')
                    ->time()
                    ->badge()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('deadline')
                    ->label('Batas Akhir')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('many_attempt')
                    ->label('Pengulangan')
                    ->badge()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuizResource\RelationManagers\QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'view' => Pages\ViewQuiz::route('/{record}'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
