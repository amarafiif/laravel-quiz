<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'thumbnail',
        'is_active',
        'is_publish'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_publish' => 'boolean',
        ];
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
