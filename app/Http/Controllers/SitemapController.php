<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap index
     */
    public function index()
    {
        $sitemaps = [
            ['loc' => route('sitemap.pages'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('sitemap.projects'), 'lastmod' => Project::latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString()],
            ['loc' => route('sitemap.articles'), 'lastmod' => Article::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString()],
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
            ['loc' => route('about'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('services'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('portfolio'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('articles'), 'changefreq' => 'daily', 'priority' => '0.8'],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('request-design.create'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('careers'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('privacy'), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['loc' => route('terms'), 'changefreq' => 'yearly', 'priority' => '0.3'],
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
     * Generate articles sitemap
     */
    public function articles()
    {
        $articles = Article::published()
            ->latest('updated_at')
            ->get()
            ->map(function ($article) {
                $images = [];
                if ($article->featured_image) {
                    $images[] = [
                        'loc' => asset('storage/'.$article->featured_image),
                        'title' => $article->title,
                        'caption' => $article->excerpt,
                    ];
                }

                return [
                    'loc' => route('articles.show', $article->slug),
                    'lastmod' => ($article->updated_at ?? $article->published_at ?? now())->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                    'images' => $images,
                ];
            });

        return response()->view('sitemap.articles', compact('articles'))
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
                'loc' => asset('storage/'.$project->main_image),
                'title' => $project->title,
                'caption' => $project->short_description,
            ];
        }

        foreach ($project->projectImages as $image) {
            $images[] = [
                'loc' => asset('storage/'.$image->image_path),
                'title' => $image->caption ?? $project->title,
                'caption' => $image->caption,
            ];
        }

        return $images;
    }
}
