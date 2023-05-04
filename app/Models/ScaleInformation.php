<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScaleInformation extends Model
{
    use HasFactory;

    protected $table = 'scale_information';

    protected $fillable = [
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
