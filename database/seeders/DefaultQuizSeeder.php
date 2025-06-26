<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class DefaultQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('No courses found. Please run DefaultCourseSeeder first.');

            return;
        }

        // Menggunakan nama unik sebagai identifier untuk quiz
        $quizzes = [
            [
                'name' => 'Kuis Pemrograman Dasar',
                'course_id' => $courses->where('code', 'CS101')->first()?->id ?? $courses->first()->id,
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman dasar pemrograman.',
                'attempt_time' => '00:30:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 3,
            ],
            [
                'name' => 'Kuis Pengembangan Web',
                'course_id' => $courses->where('code', 'CS102')->first()?->id ?? $courses->first()->id,
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang pengembangan web.',
                'attempt_time' => '00:45:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 0,
                'many_attempt' => 1,
            ],
            [
                'name' => 'Kuis Data Science',
                'course_id' => $courses->where('code', 'CS103')->first()?->id ?? $courses->first()->id,
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang data science.',
                'attempt_time' => '01:00:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 2,
            ],
            [
                'name' => 'Kuis Machine Learning',
                'course_id' => $courses->where('code', 'CS104')->first()?->id ?? $courses->first()->id,
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang machine learning.',
                'attempt_time' => '01:30:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 3,
            ],
        ];

        foreach ($quizzes as $quizData) {
            $quiz = Quiz::updateOrCreate(
                ['name' => $quizData['name']],
                $quizData
            );

            $courseName = $courses->where('id', $quiz->course_id)->first()?->name ?? 'Unknown Course';
            if ($quiz->wasRecentlyCreated) {
                $this->command->info("Quiz CREATED: {$quiz->name} (Course: {$courseName})");
            } else {
                $this->command->info("Quiz UPDATED: {$quiz->name} (Course: {$courseName})");
            }
        }
    }
}
