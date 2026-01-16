<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\CompanySetting;
use App\Models\JobApplication;
use App\Models\SocialLink;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('pages.careers', [
            'companySettings' => CompanySetting::first(),
            'socialLinks' => SocialLink::where('is_active', true)->get(),
        ]);
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = JobApplication::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_path' => $cvPath,
            'years_of_experience' => $request->years_of_experience,
            'specialization' => $request->specialization,
        ]);

        // إرسال إشعار لجميع المسؤولين
        $admins = \App\Models\User::where('is_admin', true)->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewJobApplication($application));

        // إرسال بريد إلكتروني للشركة
        $companySettings = CompanySetting::first();
        if ($companySettings && $companySettings->main_email) {
            \Illuminate\Support\Facades\Notification::route('mail', $companySettings->main_email)
                ->notify(new \App\Notifications\NewJobApplication($application));
        }

        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح. سنتواصل معك قريباً');
    }
}
