<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScaleQuestion extends Model
{
    use HasFactory;

    protected $table = 'scale_questions';

    protected $fillable = [
        'format',
        'question_text'
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];
}
