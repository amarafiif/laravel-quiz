<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

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

    public function filter(Request $request)
    {
        $query = Quiz::where('is_publish', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'popular':
                    $query->withCount('attempts')->orderBy('attempts_count', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $quizzes = $query->paginate(6)->withQueryString();

        return view('quizzes.grid', compact('quizzes'))->render();
    }

    public function show($slug)
    {
        $quiz = Quiz::with('questions')
            ->withCount('attempts')
            ->where('slug', $slug)
            ->where('is_publish', true)
            ->firstOrFail();

        return view('quizzes.show', compact('quiz'));
    }
}
