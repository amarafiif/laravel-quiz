<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class DefaultCourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'code' => 'CS101',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Pemrograman Dasar',
                'description' => 'Belajar dasar-dasar pemrograman dengan menggunakan bahasa pemrograman populer.',
                'is_active' => 1,
                'is_publish' => 1,
            ],
            [
                'code' => 'CS102',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Pengembangan Web',
                'description' => 'Mempelajari cara membangun aplikasi web menggunakan HTML, CSS, dan JavaScript.',
                'is_active' => 1,
                'is_publish' => 1,
            ],
            [
                'code' => 'CS103',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Data Science',
                'description' => 'Memahami konsep dasar data science dan analisis data menggunakan Python.',
                'is_active' => 1,
                'is_publish' => 1,
            ],
            [
                'code' => 'CS104',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Machine Learning',
                'description' => 'Belajar tentang algoritma machine learning dan penerapannya.',
                'is_active' => 1,
                'is_publish' => 1,
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::updateOrCreate(
                ['code' => $courseData['code']],
                $courseData
            );

            if ($course->wasRecentlyCreated) {
                $this->command->info("Course CREATED: {$course->name} (Code: {$course->code})");
            } else {
                $this->command->info("Course UPDATED: {$course->name} (Code: {$course->code})");
            }
        }
    }
}
