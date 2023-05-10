<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;

    protected $primaryKey = 'scaleId';

    protected $fillable = [
        'resultsAvg', 
        'resultsSD',
        'completedCount',
        'internalName',
        'officialName',
        'reference',
        'explanation',
        'options',
        'referenceMean',
        'referenceSD'
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];
}
