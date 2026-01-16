<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignRequest;
use App\Models\DesignRequest;
use App\Models\SeoSetting;

class DesignRequestController extends Controller
{
    public function create()
    {
        $seo = SeoSetting::where('page', 'request_design')->first();

        return view('pages.request-design', compact('seo'));
    }

    public function store(StoreDesignRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('design-requests', 'public');
            $data['attachment_path'] = $path;
        }

        $designRequest = DesignRequest::create($data);

        // إرسال إشعار لجميع المسؤولين
        $admins = \App\Models\User::where('is_admin', true)->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewDesignRequest($designRequest));

        // إرسال بريد إلكتروني للشركة
        $companySettings = \App\Models\CompanySetting::first();
        if ($companySettings && $companySettings->main_email) {
            \Illuminate\Support\Facades\Notification::route('mail', $companySettings->main_email)
                ->notify(new \App\Notifications\NewDesignRequest($designRequest));
        }

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }
}
