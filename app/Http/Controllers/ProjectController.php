<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected type from query parameter
        $selectedType = $request->query('type');
        
        // Build the query
        $query = Project::where('status', 'published')
            ->with('types'); // Eager load types relationship
        
        // Filter by type if specified
        if ($selectedType) {
            $query->whereHas('types', function ($q) use ($selectedType) {
                $q->where('slug', $selectedType);
            });
        }
        
        $projects = $query->paginate(9);
        $seo = SeoSetting::where('page', 'portfolio')->first();
        
        // Get all active project types for the filter
        $projectTypes = \App\Models\ProjectType::active()->ordered()->get();
        
        return view('pages.portfolio', [
            'projects' => $projects,
            'seo' => $seo,
            'projectTypes' => $projectTypes,
            'selectedType' => $selectedType,
            'heroSection' => \App\Models\HeroSection::where('page', 'portfolio')->where('is_active', true)->first(),
            'stats' => \App\Models\Stat::where('page', 'portfolio')->where('is_active', true)->orderBy('order')->get(),
            'companySettings' => \App\Models\CompanySetting::first(),
            'socialLinks' => \App\Models\SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function show(Project $project)
    {
        // Load types relationship
        $project->load('types');
        
        // Get company settings for WhatsApp
        $companySettings = \App\Models\CompanySetting::first();
        
        // SEO for project details page can be dynamic based on the project
        return view('pages.project-details', compact('project', 'companySettings'));
    }
}
