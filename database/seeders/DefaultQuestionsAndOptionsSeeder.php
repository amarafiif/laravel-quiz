<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DefaultQuestionsAndOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question_text' => 'Apa kepanjangan dari HTML?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'Hyper Text Markup Language', 'is_correct' => true],
                    ['option_text' => 'High Tech Modern Language', 'is_correct' => false],
                    ['option_text' => 'Hyperlinks Text Making Language', 'is_correct' => false],
                    ['option_text' => 'Home Tool Markup Language', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Dalam PHP, bagaimana cara mendeklarasikan variabel?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => '#variable', 'is_correct' => false],
                    ['option_text' => '$variable', 'is_correct' => true],
                    ['option_text' => '@variable', 'is_correct' => false],
                    ['option_text' => '&variable', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Apa fungsi utama dari CSS?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'Membuat logika program', 'is_correct' => false],
                    ['option_text' => 'Menyimpan data', 'is_correct' => false],
                    ['option_text' => 'Mengatur tampilan dan style website', 'is_correct' => true],
                    ['option_text' => 'Menjalankan server', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Metode HTTP yang digunakan untuk mengirim data secara aman adalah?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'GET', 'is_correct' => false],
                    ['option_text' => 'POST', 'is_correct' => true],
                    ['option_text' => 'HEAD', 'is_correct' => false],
                    ['option_text' => 'PUT', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Framework PHP yang dikembangkan oleh Taylor Otwell adalah?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'CodeIgniter', 'is_correct' => false],
                    ['option_text' => 'Symfony', 'is_correct' => false],
                    ['option_text' => 'Laravel', 'is_correct' => true],
                    ['option_text' => 'Yii', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Apa perintah artisan untuk membuat model di Laravel?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'php artisan create:model', 'is_correct' => false],
                    ['option_text' => 'php artisan make:model', 'is_correct' => true],
                    ['option_text' => 'php artisan new:model', 'is_correct' => false],
                    ['option_text' => 'php artisan generate:model', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Database yang sering digunakan dengan Laravel adalah?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'MongoDB', 'is_correct' => false],
                    ['option_text' => 'SQLite', 'is_correct' => false],
                    ['option_text' => 'PostgreSQL', 'is_correct' => false],
                    ['option_text' => 'MySQL', 'is_correct' => true],
                ]
            ],
            [
                'question_text' => 'Apa itu Eloquent dalam Laravel?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'Template Engine', 'is_correct' => false],
                    ['option_text' => 'ORM (Object-Relational Mapping)', 'is_correct' => true],
                    ['option_text' => 'Package Manager', 'is_correct' => false],
                    ['option_text' => 'Testing Framework', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'File konfigurasi utama dalam Laravel berada di folder?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => '/resources', 'is_correct' => false],
                    ['option_text' => '/public', 'is_correct' => false],
                    ['option_text' => '/config', 'is_correct' => true],
                    ['option_text' => '/storage', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Command untuk menjalankan migration di Laravel adalah?',
                'quiz_id' => 1,
                'options' => [
                    ['option_text' => 'php artisan migrate:run', 'is_correct' => false],
                    ['option_text' => 'php artisan db:migrate', 'is_correct' => false],
                    ['option_text' => 'php artisan migrate', 'is_correct' => true],
                    ['option_text' => 'php artisan migration:start', 'is_correct' => false],
                ]
            ],
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $questionData['quiz_id'],
                'question_text' => $questionData['question_text'],
            ]);

            foreach ($questionData['options'] as $optionData) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                ]);
            }
        }
    }
}
