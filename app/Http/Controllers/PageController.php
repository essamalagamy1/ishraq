<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Stat;
use App\Models\Feature;
use App\Models\Service;
use App\Models\CompanySetting;
use App\Models\SocialLink;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'heroSection' => HeroSection::where('page', 'about')->where('is_active', true)->first(),
            'stats' => Stat::where('page', 'about')->where('is_active', true)->orderBy('order')->get(),
            'features' => Feature::where('section', 'core_values')->where('is_active', true)->orderBy('order')->get(),
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'heroSection' => HeroSection::where('page', 'services')->where('is_active', true)->first(),
            'stats' => Stat::where('page', 'services')->where('is_active', true)->orderBy('order')->get(),
            'services' => Service::where('is_active', true)->with('features')->orderBy('order')->get(),
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'heroSection' => HeroSection::where('page', 'contact')->where('is_active', true)->first(),
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function privacy()
    {
        $seo = SeoSetting::where('page', 'privacy')->first();
        return view('pages.privacy', [
            'seo' => $seo,
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function terms()
    {
        $seo = SeoSetting::where('page', 'terms')->first();
        return view('pages.terms', [
            'seo' => $seo,
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }
}
