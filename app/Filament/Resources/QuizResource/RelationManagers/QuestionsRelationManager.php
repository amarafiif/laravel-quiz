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
                Section::make('Detail Soal')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        TextInput::make('question_text')
                            ->label('Teks Soal')
                            ->required()
                            ->maxLength(255),

                        Repeater::make('options')
                            ->label('Pilihan Jawaban')
                            ->relationship('options')
                            ->schema([
                                TextInput::make('option_text')
                                    ->required()
                                    ->maxLength(255),
                                Toggle::make('is_correct')
                                    ->label('Benar?')
                                    ->default(false)
                                    ->reactive(),
                                Textarea::make('explanation')
                                    ->label('Penjelasan')
                                    ->visible(fn (callable $get) => $get('is_correct'))
                                    ->placeholder('Berikan penjelasan untuk jawaban yang benar')
                                    ->maxLength(500),
                            ])
                            ->columns(1)
                            ->required()
                            ->minItems(3)
                            ->maxItems(4)
                            ->createItemButtonLabel('Tambah Pilihan'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                TextColumn::make('question_text')
                    ->label('Soal')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
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
                            ->label('Jumlah Soal')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(20)
                            ->default(5)
                            ->placeholder('Masukkan jumlah soal yang ingin dibuat (1-20)'),
                        Textarea::make('topic')
                            ->label('Topik')
                            ->required()
                            ->placeholder('e.g., Matematika, Sejarah, Sains, dll.')
                            ->helperText('Tentukan subjek atau topik untuk Soal'),
                        Textarea::make('additional_context')
                            ->label('Konteks Tambahan (Opsional)')
                            ->placeholder('Persyaratan spesifik, tingkat kesulitan, atau konteks tambahan')
                            ->helperText('Opsional: Tambahkan persyaratan atau konteks spesifik untuk menghasilkan Soal yang lebih baik'),
                    ])
                    ->action(function (array $data) {
                        if (! config('gemini.api_key')) {
                            Notification::make()
                                ->title('Gemini API Key not found!')
                                ->body('Terjadi kesalahan, silakan hubungi administrator.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $additionalContext = $data['additional_context'] ? " Konteks tambahan: {$data['additional_context']}" : '';
                        $prompt = "Buatkan saya {$data['quantity_questions']} soal pilihan ganda tentang '{$data['topic']}'.{$additionalContext}
                            Setiap soal harus memiliki 4 pilihan jawaban (A, B, C, D).
                            Hanya ada SATU jawaban yang benar untuk setiap soal.
                            Untuk jawaban yang benar, berikan penjelasan mengapa jawaban tersebut benar.
                            
                            Format JSON yang diharapkan (tanpa markdown atau teks tambahan):
                            [
                                {
                                    \"question_text\": \"Teks pertanyaan yang jelas dan spesifik\",
                                    \"options\": [
                                        {\"option_text\": \"Pilihan A\", \"is_correct\": false, \"explanation\": null},
                                        {\"option_text\": \"Pilihan B (jawaban benar)\", \"is_correct\": true, \"explanation\": \"Penjelasan lengkap mengapa jawaban ini benar\"},
                                        {\"option_text\": \"Pilihan C\", \"is_correct\": false, \"explanation\": null},
                                        {\"option_text\": \"Pilihan D\", \"is_correct\": false, \"explanation\": null}
                                    ]
                                }
                            ]
                            
                            Pastikan:
                            1. Pertanyaan berkualitas dan tidak ambigu
                            2. Pilihan jawaban masuk akal dan menantang
                            3. Penjelasan jawaban benar informatif dan edukatif
                            4. Hanya satu jawaban benar per soal";

                        try {
                            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
                            $jsonResponse = preg_replace('/^```json\s*|\s*```$/', '', $result->text());
                            $generatedQuestions = json_decode($jsonResponse, true);

                            if (json_last_error() !== JSON_ERROR_NONE || ! is_array($generatedQuestions)) {
                                throw new \Exception('Failed to decode JSON from AI response. Response: '.$jsonResponse);
                            }

                            $createdCount = 0;
                            foreach ($generatedQuestions as $questionData) {
                                if (! isset($questionData['question_text']) || ! isset($questionData['options'])) {
                                    continue;
                                }

                                $question = $this->getOwnerRecord()->questions()->create([
                                    'question_text' => $questionData['question_text'],
                                ]);

                                if (is_array($questionData['options'])) {
                                    foreach ($questionData['options'] as $optionData) {
                                        $question->options()->create([
                                            'option_text' => $optionData['option_text'],
                                            'is_correct' => $optionData['is_correct'] ?? false,
                                            'explanation' => $optionData['explanation'] ?? null,
                                        ]);
                                    }
                                    $createdCount++;
                                }
                            }

                            if ($createdCount > 0) {
                                Notification::make()
                                    ->title('Berhasil membuat soal')
                                    ->body("Berhasil membuat {$createdCount} soal dengan penjelasan.")
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Tidak ada soal yang dibuat')
                                    ->body('Format respons AI tidak valid. Silakan coba lagi.')
                                    ->warning()
                                    ->send();
                            }

                        } catch (\Exception $e) {
                            Log::error('Gemini AI Error: '.$e->getMessage());
                            Notification::make()
                                ->title('Gagal membuat soal.')
                                ->body('Silakan periksa log untuk detailnya atau coba lagi.')
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
