<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->where('is_publish', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('courses.index', [
            'courses' => CourseResource::collection($courses),
        ]);
    }

    public function show(string $id)
    {
        $course = Course::with('quizzes')
            ->findOrFail($id);

        return view('courses.show', [
            'course' => new CourseResource($course),
        ]);
    }
}
