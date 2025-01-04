<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_publish' => 'boolean',
        ];
    }
}
