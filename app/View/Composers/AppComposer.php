<?php

namespace App\View\Composers;

use App\Models\CompanySetting;
use App\Models\Service;
use App\Models\SocialLink;
use Illuminate\View\View;

class AppComposer
{
    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        try {
            $view->with([
                'companySettings' => CompanySetting::first(),
                'socialLinks' => SocialLink::where('is_active', true)->get(),
                'footerServices' => Service::where('is_active', true)->inRandomOrder()->take(4)->get(),
            ]);
        } catch (\Exception $e) {
            // Tables might not exist yet during migration or installation
            $view->with([
                'companySettings' => null,
                'socialLinks' => collect(),
                'footerServices' => collect(),
            ]);
        }
    }
}
