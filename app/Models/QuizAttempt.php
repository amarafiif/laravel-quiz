<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'started_at',
        'ends_at',
        'submitted_at',
        'score',
        'is_completed'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
        'submitted_at' => 'datetime',
        'is_completed' => 'boolean'
    ];

    protected $dates = [
        'started_at',
        'ends_at',
        'submitted_at'
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswer::class, 'quiz_attempt_id');
    }

    // public function isTimeUp(): bool
    // {
    //     return now() > $this->ends_at;
    // }

    // public function isActive(): bool
    // {
    //     return !$this->is_completed && !$this->isTimeUp();
    // }
}
