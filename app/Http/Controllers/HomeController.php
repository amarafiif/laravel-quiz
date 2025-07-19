<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $popularQuizzes = Quiz::with('attempts')
            ->withCount('attempts')
            ->orderBy('attempts_count', 'desc')
            ->paginate(3);

        return view('welcome', compact('popularQuizzes', 'categories'));
    }

    public function listQuizzes()
    {
        $categories = Category::all();
        $quizzes = Quiz::where('is_publish', true)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('quizzes.index', compact('quizzes', 'categories'));
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

        $quizzes = $query->paginate(3)->withQueryString();

        if ($request->ajax() || $request->has('ajax')) {
            return view('quizzes.grid', compact('quizzes'))->render();
        }

        return redirect()->route('list.quizzes');
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
