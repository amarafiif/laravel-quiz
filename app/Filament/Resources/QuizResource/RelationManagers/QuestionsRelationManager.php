<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Question Details')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        TextInput::make('question_text')
                            ->label('Question Text')
                            ->required()
                            ->maxLength(255),

                        Repeater::make('options')
                            ->label('Options')
                            ->relationship('options')
                            ->schema([
                                TextInput::make('option_text')
                                    ->required()
                                    ->maxLength(255),
                                Toggle::make('is_correct')
                                    ->label('Is Correct?')
                                    ->default(false),
                            ])
                            ->columns(1)
                            ->required()
                            ->minItems(3)
                            ->maxItems(4)
                            ->createItemButtonLabel('Add Option'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                TextColumn::make('question_text')
                    ->label('Question')
                    ->searchable()
                    ->sortable(),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('generative_ai')
                    ->label('AI Generative')
                    ->icon('heroicon-o-sparkles')
                    ->color('primary')
                    ->form([
                        TextInput::make('quantity_questions')
                            ->label('Number of Questions')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(20)
                            ->default(5)
                            ->placeholder('Enter number of questions to generate'),
                        Textarea::make('prompt')
                            ->label('Prompt')
                            ->required()
                            ->placeholder('Enter your prompt for AI to generate questions'),
                    ])
                    ->action(function () {
                        // Logic to generate questions with AI
                    }),
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
