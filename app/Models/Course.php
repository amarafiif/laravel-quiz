<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'thumbnail',
        'is_active',
        'is_publish',
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

    public static function generateCode(): string
    {
        $lastRecord = static::orderBy('id', 'desc')->first();

        if (! $lastRecord) {
            return 'CRS000000001';
        }

        $lastNumber = (int) substr($lastRecord->code, 3);
        $nextNumber = $lastNumber + 1;

        return 'CRS'.str_pad($nextNumber, 9, '0', STR_PAD_LEFT);
    }
}
