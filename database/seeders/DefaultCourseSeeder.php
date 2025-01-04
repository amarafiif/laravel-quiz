<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CS102',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Pengembangan Web',
                'description' => 'Mempelajari cara membangun aplikasi web menggunakan HTML, CSS, dan JavaScript.',
                'is_active' => 1,
                'is_publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CS103',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Data Science',
                'description' => 'Memahami konsep dasar data science dan analisis data menggunakan Python.',
                'is_active' => 1,
                'is_publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CS104',
                'thumbnail' => 'https://dummyimage.com/600x320/5e575e/a8a9bf',
                'name' => 'Machine Learning',
                'description' => 'Belajar tentang algoritma machine learning dan penerapannya.',
                'is_active' => 1,
                'is_publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data ke dalam tabel courses
        DB::table('courses')->insert($courses);
    }
}
