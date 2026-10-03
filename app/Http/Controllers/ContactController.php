<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\CompanySetting;
use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\NewContactMessage;
use App\Services\SpamProtectionService;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(StoreContactMessageRequest $request, SpamProtectionService $spamService)
    {
        // Anti-bot & spam check: silently discard bot submissions without sending notifications/emails
        if ($spamService->isSpam($request)) {
            return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح');
        }

        $message = ContactMessage::create($request->validated());

        // إرسال إشعار Filament لجميع المسؤولين
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            FilamentNotification::make()
                ->title('رسالة جديدة من '.$message->name)
                ->body(substr($message->message, 0, 100).'...')
                ->icon('heroicon-o-envelope')
                ->iconColor('info')
                ->sendToDatabase($admin);
        }

        // إرسال بريد إلكتروني للشركة
        $companySettings = CompanySetting::first();
        if ($companySettings && $companySettings->main_email) {
            Notification::route('mail', $companySettings->main_email)
                ->notify(new NewContactMessage($message));
        }

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح');
    }
}

