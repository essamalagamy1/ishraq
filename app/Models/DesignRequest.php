<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company_name',
        'project_type',
        'budget_range',
        'deadline',
        'details',
        'attachment_path',
        'status',
    ];
}
