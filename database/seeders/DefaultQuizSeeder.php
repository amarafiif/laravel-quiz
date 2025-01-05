<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        $quizzes = [
            [
                'course_id' => $courses->random()->id,
                'name' => 'Kuis Pemrograman Dasar',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman dasar pemrograman.',
                'attempt_time' => '00:30:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $courses->random()->id,
                'name' => 'Kuis Pengembangan Web',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang pengembangan web.',
                'attempt_time' => '00:45:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 0,
                'many_attempt' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $courses->random()->id,
                'name' => 'Kuis Data Science',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang data science.',
                'attempt_time' => '01:00:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $courses->random()->id,
                'name' => 'Kuis Machine Learning',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'description' => 'Kuis ini menguji pemahaman tentang machine learning.',
                'attempt_time' => '01:30:00',
                'deadline' => now()->addDays(7),
                'is_allowed_repeat' => 1,
                'many_attempt' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Quiz::insert($quizzes);
    }
}
