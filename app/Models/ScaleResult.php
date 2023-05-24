<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScaleResult extends Model
{
    use HasFactory;

    protected $table = 'scaleResults';

    protected $primaryKey = 'resultId';

    protected $fillable = [
        'score',
        'user_id', 
        'scale_id'
    ];

    protected $casts = [
        'user_id',
        'scale_id'
    ];

    public function Scale() {
        return $this->belongsTo(Scale::class, 'scale_id', 'scale_id');
    }

    public function User() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
