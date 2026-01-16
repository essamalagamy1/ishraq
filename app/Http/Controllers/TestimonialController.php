<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('pages.add-testimonial', [
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'testimonial' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'client_name.required' => 'الاسم مطلوب',
            'client_position.required' => 'المنصب مطلوب',
            'testimonial.required' => 'نص التقييم مطلوب',
            'testimonial.min' => 'يجب أن يكون التقييم 10 أحرف على الأقل',
            'rating.required' => 'التقييم مطلوب',
            'rating.min' => 'التقييم يجب أن يكون من 1 إلى 5',
            'rating.max' => 'التقييم يجب أن يكون من 1 إلى 5',
        ]);

        // Create testimonial with default values
        $testimonial = Testimonial::create([
            'client_name' => $validated['client_name'],
            'client_position' => $validated['client_position'],
            'client_company' => $validated['client_company'],
            'content' => $validated['testimonial'],
            'rating' => $validated['rating'],
            'is_active' => true,
            'is_featured' => true,
            'is_verified' => false,
            'order' => 0,
        ]);

        // إرسال إشعار لجميع المسؤولين
        $admins = \App\Models\User::where('is_admin', true)->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewTestimonial($testimonial));

        // إرسال بريد إلكتروني للشركة
        $companySettings = CompanySetting::first();
        if ($companySettings && $companySettings->main_email) {
            \Illuminate\Support\Facades\Notification::route('mail', $companySettings->main_email)
                ->notify(new \App\Notifications\NewTestimonial($testimonial));
        }

        return redirect()->route('testimonial.create')->with('success', 'شكراً لك! تم إرسال تقييمك بنجاح. سيتم مراجعته ونشره قريباً.');
    }
}
