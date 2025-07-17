<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularQuizzes = Quiz::with('attempts')
            ->withCount('attempts')
            ->orderBy('attempts_count', 'desc')
            ->paginate(3);

        return view('welcome', compact('popularQuizzes'));
    }

    public function listQuizzes()
    {
        $quizzes = Quiz::where('is_publish', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('quizzes.index', compact('quizzes'));
    }
}
