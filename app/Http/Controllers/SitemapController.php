<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap index directly in PHP (immune to Blade/short_open_tag errors)
     */
    public function index(): Response
    {
        $sitemaps = [
            ['loc' => route('sitemap.pages'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('sitemap.projects'), 'lastmod' => Project::latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString()],
            ['loc' => route('sitemap.articles'), 'lastmod' => Article::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString()],
        ];

        $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($sitemaps as $sitemap) {
            $xml .= "    <sitemap>\n";
            $xml .= "        <loc>" . htmlspecialchars($sitemap['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . htmlspecialchars($sitemap['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= "    </sitemap>\n";
        }

        $xml .= '</sitemapindex>' . "\n";

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }

    /**
     * Generate pages sitemap
     */
    public function pages(): Response
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

        $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($pages as $page) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars($page['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <changefreq>" . htmlspecialchars($page['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
            $xml .= "        <priority>" . htmlspecialchars($page['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>' . "\n";

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }

    /**
     * Generate projects sitemap
     */
    public function projects(): Response
    {
        $projects = Project::where('status', 'published')
            ->latest('updated_at')
            ->get();

        $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($projects as $project) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars(route('projects.show', $project), ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . htmlspecialchars($project->updated_at->toAtomString(), ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= "        <changefreq>monthly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";

            $images = $this->getProjectImages($project);
            foreach ($images as $img) {
                $xml .= "        <image:image>\n";
                $xml .= "            <image:loc>" . htmlspecialchars($img['loc'], ENT_XML1, 'UTF-8') . "</image:loc>\n";
                if (!empty($img['title'])) {
                    $xml .= "            <image:title>" . htmlspecialchars($img['title'], ENT_XML1, 'UTF-8') . "</image:title>\n";
                }
                if (!empty($img['caption'])) {
                    $xml .= "            <image:caption>" . htmlspecialchars($img['caption'], ENT_XML1, 'UTF-8') . "</image:caption>\n";
                }
                $xml .= "        </image:image>\n";
            }

            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>' . "\n";

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }

    /**
     * Generate articles sitemap
     */
    public function articles(): Response
    {
        $articles = Article::published()
            ->latest('updated_at')
            ->get();

        $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($articles as $article) {
            $lastmod = ($article->updated_at ?? $article->published_at ?? now())->toAtomString();
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars(route('articles.show', $article->slug), ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";

            if ($article->featured_image) {
                $xml .= "        <image:image>\n";
                $xml .= "            <image:loc>" . htmlspecialchars(asset('storage/' . $article->featured_image), ENT_XML1, 'UTF-8') . "</image:loc>\n";
                if (!empty($article->title)) {
                    $xml .= "            <image:title>" . htmlspecialchars($article->title, ENT_XML1, 'UTF-8') . "</image:title>\n";
                }
                if (!empty($article->excerpt)) {
                    $xml .= "            <image:caption>" . htmlspecialchars($article->excerpt, ENT_XML1, 'UTF-8') . "</image:caption>\n";
                }
                $xml .= "        </image:image>\n";
            }

            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>' . "\n";

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
    }

    /**
     * Get project images for image sitemap
     */
    private function getProjectImages($project): array
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
