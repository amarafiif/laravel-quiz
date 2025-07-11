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

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Quiz Information')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->label('Quiz Name')
                            ->required(),
                        MarkdownEditor::make('description')
                            ->label('Description')
                            ->maxLength(500)
                            ->required()
                            ->toolbarButtons([
                                // 'attachFiles',
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
                            ->label('Thumbnail Quiz')
                            ->image()
                            ->directory('thumbnail/quiz')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->required(),
                    ]),

                Section::make('Quiz Settings')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TimePicker::make('attempt_time')
                                    ->label('Attempt Time')
                                    ->required()
                                    ->hint('The time allowed for each quiz attempt.')
                                    ->hintColor('warning')
                                    ->default(now()->addMinutes(30)),
                                DateTimePicker::make('deadline')
                                    ->label('Deadline')
                                    ->required()
                                    ->native(false)
                                    ->seconds(false)
                                    ->hint('The deadline for quiz submission.')
                                    ->hintColor('warning')
                                    ->default(now()->addDays(7)),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_allowed_repeat')
                                    ->label('Allow Many Attempts')
                                    ->inline(false)
                                    ->helperText('If enabled, users can attempt the quiz multiple times.')
                                    ->default(false)
                                    ->live(),
                                TextInput::make('many_attempt')
                                    ->label('Attempt Limit')
                                    ->numeric()
                                    ->default(1)
                                    ->required(fn ($get) => $get('is_allowed_repeat') === true)
                                    ->helperText('Set the maximum number of attempts allowed if "Allow Many Attempts" is enabled.')
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
                    ->label('Course')
                    ->limit(20)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->label('Quiz Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),
                TextColumn::make('attempt_time')
                    ->label('Attempt Time')
                    ->time()
                    ->badge()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('many_attempt')
                    ->label('Many Attempts')
                    ->badge()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
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
