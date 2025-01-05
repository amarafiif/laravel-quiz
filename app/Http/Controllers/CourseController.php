<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('courses.index', [
            'courses' => CourseResource::collection($courses)
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
