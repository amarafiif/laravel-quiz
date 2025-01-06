<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function start(Quiz $quiz)
    {
        if ($quiz->deadline && Carbon::parse($quiz->deadline) < now()) {
            return redirect()->back()
                ->with('error', 'Kuis ini sudah melewati batas waktu pengerjaan.');
        }

        $previousAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->where('is_completed', true)
            ->first();

        if ($previousAttempt && !$quiz->is_allowed_repeat) {
            return redirect()->back()
                ->with('error', 'Anda sudah mengerjakan kuis ini dan tidak diizinkan untuk mengulangi.');
        }

        $activeAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->where('is_completed', false)
            ->where('ends_at', '>', now())
            ->first();

        if ($activeAttempt) {
            return redirect()->route('quiz.attempt', $activeAttempt->id);
        }

        $now = now();
        $minutes = (int) Carbon::parse($quiz->attempt_time)->format('i');
        $attempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'started_at' => $now,
            'ends_at' => $now->copy()->addMinutes($minutes),
            'is_completed' => false,
            'submitted_at' => null,
            'score' => null
        ]);

        return redirect()->route('quiz.attempt', $attempt->id);
    }

    public function showAttempt(QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->is_completed) {
            return redirect()->route('quiz.result', $attempt->id)
                ->with('info', 'Kuis ini sudah selesai dikerjakan.');
        }

        if ($attempt->ends_at < now()) {
            $this->submitAutomatically($attempt);
            return redirect()->route('quiz.result', $attempt->id)
                ->with('warning', 'Waktu pengerjaan telah habis.');
        }

        $questions = $attempt->quiz->questions()->with('options')->get();
        $remainingTime = max(0, (int) now()->diffInSeconds($attempt->ends_at));
        $userAnswers = UserAnswer::where('quiz_attempt_id', $attempt->id)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();


        return view('quiz.attempt', [
            'attempt' => $attempt,
            'questions' => $questions,
            'userAnswers' => $userAnswers,
            'remainingTime' => $remainingTime
        ]);
    }

    private function submitAutomatically(QuizAttempt $attempt)
    {
        if (!$attempt->is_completed) {
            $this->calculateScore($attempt);
        }
    }

    public function saveAnswer(Request $request, QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->ends_at < now()) {
            return response()->json(['message' => 'Waktu pengerjaan telah habis'], 403);
        }

        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_id' => 'required|exists:options,id'
        ]);

        $option = \App\Models\Option::find($validated['option_id']);
        $isCorrect = $option->is_correct;

        UserAnswer::updateOrCreate(
            [
                'quiz_attempt_id' => $attempt->id,
                'question_id' => $validated['question_id']
            ],
            [
                'selected_option_id' => $validated['option_id'],
                'is_correct' => $isCorrect
            ]
        );

        return response()->json(['message' => 'Jawaban berhasil disimpan']);
    }

    public function submit(QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->is_completed) {
            return redirect()->route('quiz.result', $attempt->id);
        }

        $this->calculateScore($attempt);

        return redirect()->route('quiz.result', $attempt->id)
            ->with('success', 'Kuis berhasil diselesaikan!');
    }

    public function showResult(QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $questions = $attempt->quiz->questions()->with('options')->get();

        $userAnswers = UserAnswer::where('quiz_attempt_id', $attempt->id)
            ->get()
            ->keyBy('question_id');

        return view('quiz.result', compact('attempt', 'questions', 'userAnswers'));
    }

    private function calculateScore(QuizAttempt $attempt)
    {
        $totalQuestions = $attempt->quiz->questions()->count();
        $correctAnswers = UserAnswer::where('quiz_attempt_id', $attempt->id)
            ->where('is_correct', true)
            ->count();

        $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

        $attempt->update([
            'score' => $score,
            'is_completed' => true,
            'submitted_at' => now()
        ]);
    }
}
