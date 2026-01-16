<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProjectType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'color',
        'icon',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get projects that belong to this type
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_project_type');
    }

    /**
     * Get the name based on current locale
     */
    public function getNameAttribute()
    {
        return App::getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * Scope to get only active types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by custom order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
