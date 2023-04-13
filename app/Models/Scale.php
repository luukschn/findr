<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;

    protected $primaryKey = 'scaleId';

    protected $fillable = [
        'sourceAvg',
        'sourceSD', 
        'resultsAvg', 
        'resultsSD',
        'completedCount'
    ];
}
