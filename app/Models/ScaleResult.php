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
        'score'
    ];

    protected $casts = [
        'userId',
        'scaleId'
    ];
}
