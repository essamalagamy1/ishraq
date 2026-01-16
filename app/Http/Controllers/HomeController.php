<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CompanySetting;
use App\Models\Feature;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Stat;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'heroSection' => HeroSection::where('page', 'home')->where('is_active', true)->first(),
            'stats' => Stat::where('page', 'home')->where('is_active', true)->orderBy('order')->get(),
            'services' => Service::where('is_active', true)->with('features')->orderBy('order')->take(6)->get(),
            'features' => Feature::where('section', 'why_choose_us')->where('is_active', true)->orderBy('order')->get(),
            'testimonials' => Testimonial::where('is_featured', true)->where('is_active', true)->orderBy('order')->get(),
            'featuredProjects' => Project::where('is_featured', true)->where('status', 'published')->with('types')->inRandomOrder()->get(),
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
            'latestArticles' => Article::published()->orderBy('published_at', 'desc')->take(3)->get(),
        ]);
    }
}
