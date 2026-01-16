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
Route::get('/robots.txt', function () {
    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin\n";
    $content .= "Disallow: /api\n\n";
    $content .= 'Sitemap: '.route('sitemap.index')."\n";

    return response($content)->header('Content-Type', 'text/plain');
})->name('robots');

// The default welcome route can be removed or kept for testing
// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Note: Filament routes are automatically registered by the service provider.
// The login route will be /admin/login by default.
