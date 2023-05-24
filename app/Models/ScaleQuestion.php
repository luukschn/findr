<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScaleQuestion extends Model
{
    use HasFactory;

    protected $table = 'scale_questions';

    protected $foreignKey = 'scale_id';

    protected $fillable = [
        'format',
        'question_text'
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];

    public function Scale() {
        return $this->belongsTo(Scale::class, 'scale_id', 'scale_id');
    }
}
