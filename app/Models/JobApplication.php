<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cv_path',
        'years_of_experience',
        'specialization',
        'status',
        'notes',
    ];

    protected $casts = [
        'years_of_experience' => 'integer',
    ];
}
