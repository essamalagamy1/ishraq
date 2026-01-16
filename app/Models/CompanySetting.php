<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'main_email',
        'secondary_email',
        'phone_primary',
        'phone_secondary',
        'whatsapp_number',
        'location_text',
        'about_short',
        'logo_path',
        'logo_2_path',
        'favicon_path',
        'terms_conditions',
        'privacy_policy',
    ];
}
