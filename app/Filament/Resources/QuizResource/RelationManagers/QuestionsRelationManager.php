<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;

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
                    ->action(function (array $data) {
                        if (! config('gemini.api_key')) {
                            Notification::make()
                                ->title('Gemini API Key not found!')
                                ->body('Please contact developer to report this issue.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $prompt = "Buatkan saya {$data['quantity_questions']} soal pilihan ganda tentang '{$data['prompt']}'.
                            Setiap soal harus memiliki 4 pilihan jawaban.
                            Hanya ada SATU jawaban yang benar untuk setiap soal.
                            Tolong berikan jawaban HANYA dalam format JSON yang valid, tanpa teks atau markdown tambahan. Strukturnya harus seperti ini:
                            [
                                {
                                    \"question_text\": \"Teks pertanyaan di sini\",
                                    \"options\": [
                                        {\"option_text\": \"Teks pilihan A\", \"is_correct\": false},
                                        {\"option_text\": \"Teks pilihan B (jawaban benar)\", \"is_correct\": true},
                                        {\"option_text\": \"Teks pilihan C\", \"is_correct\": false},
                                        {\"option_text\": \"Teks pilihan D\", \"is_correct\": false}
                                    ]
                                }
                            ]";

                        try {
                            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
                            $jsonResponse = preg_replace('/^```json\s*|\s*```$/', '', $result->text());
                            $generatedQuestions = json_decode($jsonResponse, true);

                            if (json_last_error() !== JSON_ERROR_NONE || ! is_array($generatedQuestions)) {
                                throw new \Exception('Failed to decode JSON from AI response. Response: '.$jsonResponse);
                            }

                            foreach ($generatedQuestions as $questionData) {
                                $question = $this->getOwnerRecord()->questions()->create([
                                    'question_text' => $questionData['question_text'],
                                ]);

                                if (isset($questionData['options']) && is_array($questionData['options'])) {
                                    $question->options()->createMany($questionData['options']);
                                }
                            }

                            Notification::make()
                                ->title('Questions generated successfully!')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            Log::error('Gemini AI Error: '.$e->getMessage());
                            Notification::make()
                                ->title('Failed to generate questions.')
                                ->body('Please check the log for details.')
                                ->danger()
                                ->send();
                        }
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
