<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap index
     */
    public function index()
    {
        $sitemaps = [
            ['loc' => route('sitemap.pages'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('sitemap.projects'), 'lastmod' => Project::latest('updated_at')->first()?->updated_at->toAtomString()],
        ];

        return response()->view('sitemap.index', compact('sitemaps'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Generate pages sitemap
     */
    public function pages()
    {
        $pages = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('services'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('portfolio'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('request-design.create'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ];

        return response()->view('sitemap.pages', compact('pages'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Generate projects sitemap
     */
    public function projects()
    {
        $projects = Project::where('status', 'published')
            ->latest('updated_at')
            ->get()
            ->map(function ($project) {
                return [
                    'loc' => route('projects.show', $project),
                    'lastmod' => $project->updated_at->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                    'images' => $this->getProjectImages($project),
                ];
            });

        return response()->view('sitemap.projects', compact('projects'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Get project images for image sitemap
     */
    private function getProjectImages($project)
    {
        $images = [];

        if ($project->main_image) {
            $images[] = [
                'loc' => asset('storage/' . $project->main_image),
                'title' => $project->title,
                'caption' => $project->short_description,
            ];
        }

        foreach ($project->projectImages as $image) {
            $images[] = [
                'loc' => asset('storage/' . $image->image_path),
                'title' => $image->caption ?? $project->title,
                'caption' => $image->caption,
            ];
        }

        return $images;
    }
}
