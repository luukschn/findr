<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extendedUserInfo extends Model
{
    use HasFactory;

    protected $table = 'extendedUserInfo';

    protected $primaryKey = 'userId';

    protected $fillable = [
        'dateOfBirth',
        'country', 
        'location', 
        'jobTitle',
        'educationLevel', 
        'gender',
        'bio'
    ];

    protected $casts = [
        'created_at',
        'updated_at'
    ];
}
