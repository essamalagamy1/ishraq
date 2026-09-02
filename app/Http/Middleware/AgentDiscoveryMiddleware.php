<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Article;
use App\Models\Project;
use App\Models\CompanySetting;
use App\Models\Service;

class AgentDiscoveryMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Add RFC 8288 Link headers for agent discovery on all public pages
        if (! $request->is('admin*') && ! $request->is('filament*')) {
            $linkHeaders = [
                '</.well-known/api-catalog>; rel="api-catalog"',
                '</docs/api>; rel="service-doc"',
                '</.well-known/ai-catalog.json>; rel="ai-catalog"',
                '</.well-known/agent-skills/index.json>; rel="agent-skills"',
                '</.well-known/mcp/server-card.json>; rel="mcp-server-card"',
                '</.well-known/oauth-protected-resource>; rel="oauth-protected-resource"',
            ];

            $response->headers->set('Link', implode(', ', $linkHeaders));
        }

        // 2. Markdown content negotiation (Markdown for Agents)
        $acceptHeader = $request->header('Accept', '');
        if (str_contains($acceptHeader, 'text/markdown') && $request->isMethod('GET') && ! $request->is('admin*') && ! $request->is('filament*')) {
            $markdown = $this->generateMarkdown($request, $response);
            $tokenCount = (int) ceil(mb_strlen($markdown) / 4);

            return response($markdown, 200, [
                'Content-Type' => 'text/markdown; charset=utf-8',
                'x-markdown-tokens' => (string) $tokenCount,
                'Vary' => 'Accept',
                'Link' => $response->headers->get('Link', ''),
            ]);
        }

        return $response;
    }

    /**
     * Generate markdown representation for the requested page
     */
    protected function generateMarkdown(Request $request, Response $response): string
    {
        $path = trim($request->path(), '/');

        if ($path === '' || $path === '/') {
            return $this->generateHomeMarkdown();
        }

        if ($path === 'about-us') {
            return $this->generateAboutMarkdown();
        }

        if ($path === 'services') {
            return $this->generateServicesMarkdown();
        }

        if ($path === 'portfolio') {
            return $this->generatePortfolioMarkdown();
        }

        if (str_starts_with($path, 'projects/')) {
            $slug = substr($path, strlen('projects/'));
            return $this->generateProjectMarkdown($slug);
        }

        if ($path === 'articles') {
            return $this->generateArticlesMarkdown();
        }

        if (str_starts_with($path, 'articles/')) {
            $slug = substr($path, strlen('articles/'));
            return $this->generateArticleMarkdown($slug);
        }

        if ($path === 'contact-us') {
            return $this->generateContactMarkdown();
        }

        // Fallback: extract clean text/markdown from HTML response content
        $content = $response->getContent();
        if ($content && is_string($content) && str_contains($content, '<html')) {
            return $this->htmlToMarkdownFallback($content);
        }

        return "# Ishraq Tech\n\nVisit https://ishraq.tech for more information.";
    }

    protected function generateHomeMarkdown(): string
    {
        $company = CompanySetting::first();
        $name = $company?->site_name ?? 'إشراق تك - Ishraq Tech';
        $desc = $company?->meta_description ?? 'وكالة رقمية رائدة متخصصة في تطوير البرمجيات، وتصميم واجهات وتجربة المستخدم UI/UX، وبناء الهويات التجارية المتكاملة.';

        $services = Service::where('is_active', true)->take(6)->get();
        $projects = Project::where('status', 'published')->latest()->take(4)->get();
        $articles = Article::published()->latest()->take(3)->get();

        $md = "# {$name}\n\n";
        $md .= "{$desc}\n\n";
        $md .= "## Services Offered\n\n";

        foreach ($services as $service) {
            $md .= "- **{$service->title}**: " . strip_tags($service->short_description ?? $service->description) . "\n";
        }

        if ($projects->isNotEmpty()) {
            $md .= "\n## Featured Projects\n\n";
            foreach ($projects as $proj) {
                $md .= "- [{$proj->title}](https://ishraq.tech/projects/{$proj->slug}): " . strip_tags($proj->short_description) . "\n";
            }
        }

        if ($articles->isNotEmpty()) {
            $md .= "\n## Latest Articles\n\n";
            foreach ($articles as $art) {
                $md .= "- [{$art->title}](https://ishraq.tech/articles/{$art->slug}) - " . ($art->published_at?->format('Y-m-d') ?? '') . "\n";
            }
        }

        $md .= "\n## Contact & Links\n\n";
        $md .= "- Website: https://ishraq.tech\n";
        $md .= "- API Catalog: https://ishraq.tech/.well-known/api-catalog\n";
        $md .= "- MCP Server: https://ishraq.tech/.well-known/mcp/server-card.json\n";
        $md .= "- AI Catalog: https://ishraq.tech/.well-known/ai-catalog.json\n";

        return $md;
    }

    protected function generateAboutMarkdown(): string
    {
        $company = CompanySetting::first();
        $md = "# About Ishraq Tech (من نحن)\n\n";
        $md .= "إشراق تك هي وكالة حلول رقمية متكاملة تقدم خدمات هندسة البرمجيات، وتطبيقات الويب والموبايل، وتصميم الهويات المؤسسية وتجارب المستخدم الاحترافية.\n\n";
        if ($company?->about_us) {
            $md .= strip_tags($company->about_us) . "\n\n";
        }
        $md .= "Learn more at: https://ishraq.tech/about-us\n";
        return $md;
    }

    protected function generateServicesMarkdown(): string
    {
        $services = Service::where('is_active', true)->get();
        $md = "# Ishraq Services (خدمات إشراق)\n\n";
        foreach ($services as $service) {
            $md .= "### {$service->title}\n\n";
            $md .= strip_tags($service->description ?? $service->short_description) . "\n\n";
        }
        return $md;
    }

    protected function generatePortfolioMarkdown(): string
    {
        $projects = Project::where('status', 'published')->latest()->get();
        $md = "# Ishraq Portfolio (معرض أعمالنا)\n\n";
        foreach ($projects as $p) {
            $md .= "### [{$p->title}](https://ishraq.tech/projects/{$p->slug})\n\n";
            $md .= strip_tags($p->short_description ?? '') . "\n\n";
        }
        return $md;
    }

    protected function generateProjectMarkdown(string $slug): string
    {
        $proj = Project::where('slug', $slug)->first();
        if (! $proj) {
            return "# Project Not Found\n\nThe requested project could not be found.";
        }

        $md = "# {$proj->title}\n\n";
        if ($proj->category) {
            $md .= "**Category:** {$proj->category}\n\n";
        }
        $md .= strip_tags($proj->description ?? $proj->short_description) . "\n\n";
        if ($proj->project_url) {
            $md .= "Live Demo: {$proj->project_url}\n\n";
        }
        return $md;
    }

    protected function generateArticlesMarkdown(): string
    {
        $articles = Article::published()->latest()->get();
        $md = "# Ishraq Tech Blog (المدونة والمقالات)\n\n";
        foreach ($articles as $a) {
            $md .= "### [{$a->title}](https://ishraq.tech/articles/{$a->slug})\n";
            $md .= strip_tags($a->excerpt ?? '') . "\n\n";
        }
        return $md;
    }

    protected function generateArticleMarkdown(string $slug): string
    {
        $art = Article::published()->where('slug', $slug)->first();
        if (! $art) {
            return "# Article Not Found\n\nThe requested article could not be found.";
        }

        $md = "# {$art->title}\n\n";
        $md .= "**Published:** " . ($art->published_at?->format('Y-m-d') ?? '') . "\n\n";
        $md .= strip_tags($art->content) . "\n\n";
        return $md;
    }

    protected function generateContactMarkdown(): string
    {
        $company = CompanySetting::first();
        $md = "# Contact Ishraq Tech (تواصل معنا)\n\n";
        $md .= "- Email: " . ($company?->email ?? 'info@ishraq.tech') . "\n";
        $md .= "- Phone: " . ($company?->phone ?? '') . "\n";
        $md .= "- WhatsApp: " . ($company?->whatsapp_number ?? '') . "\n";
        $md .= "- Address: " . ($company?->address ?? 'المملكة العربية السعودية / جمهورية مصر العربية') . "\n";
        return $md;
    }

    protected function htmlToMarkdownFallback(string $html): string
    {
        // Strip scripts and styles
        $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);
        $html = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html);
        $html = preg_replace('/<nav\b[^>]*>(.*?)<\/nav>/is', '', $html);
        $html = preg_replace('/<footer\b[^>]*>(.*?)<\/footer>/is', '', $html);

        $text = strip_tags($html, '<h1><h2><h3><h4><p><a><ul><ol><li>');
        $text = preg_replace('/<h1[^>]*>(.*?)<\/h1>/i', "\n# $1\n", $text);
        $text = preg_replace('/<h2[^>]*>(.*?)<\/h2>/i', "\n## $1\n", $text);
        $text = preg_replace('/<h3[^>]*>(.*?)<\/h3>/i', "\n### $1\n", $text);
        $text = preg_replace('/<h4[^>]*>(.*?)<\/h4>/i', "\n#### $1\n", $text);
        $text = preg_replace('/<p[^>]*>(.*?)<\/p>/i', "\n$1\n", $text);
        $text = preg_replace('/<li[^>]*>(.*?)<\/li>/i', "- $1\n", $text);
        $text = preg_replace('/<a\s+[^>]*href="([^"]*)"[^>]*>(.*?)<\/a>/i', '[$2]($1)', $text);

        return trim(strip_tags($text));
    }
}
