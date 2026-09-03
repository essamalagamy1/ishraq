<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DesignRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/portfolio', [ProjectController::class, 'index'])->name('portfolio');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/request-a-design', [DesignRequestController::class, 'create'])->name('request-design.create');
Route::post('/request-a-design', [DesignRequestController::class, 'store'])->name('request-design.store');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/add-testimonial', [TestimonialController::class, 'create'])->name('testimonial.create');
Route::post('/add-testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');

// Articles/Blog Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Careers/Jobs Routes
Route::get('/careers', [JobApplicationController::class, 'index'])->name('careers');
Route::post('/careers', [JobApplicationController::class, 'store'])->name('careers.store');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap-projects.xml', [SitemapController::class, 'projects'])->name('sitemap.projects');
Route::get('/sitemap-articles.xml', [SitemapController::class, 'articles'])->name('sitemap.articles');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin\n";
    $content .= "Disallow: /api\n\n";
    $content .= 'Sitemap: '.route('sitemap.index')."\n";
    $content .= "Agentmap: https://ishraq.tech/.well-known/ai-catalog.json\n";

    return response($content)->header('Content-Type', 'text/plain');
})->name('robots');

// AI Agent Discovery & Standards Endpoints
use App\Http\Controllers\AgentDiscoveryController;

Route::get('/.well-known/api-catalog', [AgentDiscoveryController::class, 'apiCatalog'])->name('agent.api-catalog');
Route::get('/.well-known/ai-catalog.json', [AgentDiscoveryController::class, 'aiCatalog'])->name('agent.ai-catalog');
Route::get('/.well-known/mcp/server-card.json', [AgentDiscoveryController::class, 'mcpServerCard'])->name('agent.mcp-server-card');
Route::get('/.well-known/mcp/server-cards.json', [AgentDiscoveryController::class, 'mcpServerCard']);
Route::get('/.well-known/mcp.json', [AgentDiscoveryController::class, 'mcpServerCard']);
Route::get('/.well-known/agent-card.json', [AgentDiscoveryController::class, 'agentCard'])->name('agent.card');
Route::get('/.well-known/agent-skills/index.json', [AgentDiscoveryController::class, 'agentSkillsIndex'])->name('agent.skills.index');
Route::get('/.well-known/skills/index.json', [AgentDiscoveryController::class, 'agentSkillsIndex']);
Route::get('/.well-known/agent-skills/{skill}/SKILL.md', [AgentDiscoveryController::class, 'agentSkillFile'])->name('agent.skill.file');
Route::get('/.well-known/oauth-protected-resource', [AgentDiscoveryController::class, 'oauthProtectedResource'])->name('agent.oauth-protected-resource');
Route::get('/.well-known/oauth-authorization-server', [AgentDiscoveryController::class, 'oauthAuthorizationServer'])->name('agent.oauth-auth-server');
Route::get('/.well-known/openid-configuration', [AgentDiscoveryController::class, 'oauthAuthorizationServer'])->name('agent.openid-config');
Route::get('/.well-known/jwks.json', [AgentDiscoveryController::class, 'jwks'])->name('agent.jwks');
Route::get('/.well-known/http-message-signatures-directory', [AgentDiscoveryController::class, 'botAuthDirectory'])->name('agent.bot-auth');
Route::get('/auth.md', [AgentDiscoveryController::class, 'authMd'])->name('agent.auth-md');
Route::get('/openapi.json', [AgentDiscoveryController::class, 'openapi'])->name('agent.openapi');
Route::get('/docs/api', [AgentDiscoveryController::class, 'docs'])->name('agent.docs');
Route::get('/api/health', [AgentDiscoveryController::class, 'health'])->name('agent.health');
Route::get('/status', [AgentDiscoveryController::class, 'health']);

// The default welcome route can be removed or kept for testing
// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Note: Filament routes are automatically registered by the service provider.
// The login route will be /admin/login by default.
