<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtendedUserInfo extends Model
{
    use HasFactory;
    
    protected $factory = 'ExtendedUserInfoFactory';
    
    protected $table = 'extendedUserInfo';

    protected $primaryKey = 'id';

    // protected $foreignKey = 'user_id';

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

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
