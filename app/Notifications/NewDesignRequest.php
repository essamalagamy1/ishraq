<?php

namespace App\Notifications;

use App\Models\DesignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDesignRequest extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public DesignRequest $request
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('طلب تصميم جديد')
            ->greeting('مرحباً!')
            ->line('تم استلام طلب تصميم جديد.')
            ->line('**الاسم:** '.$this->request->name)
            ->line('**البريد الإلكتروني:** '.$this->request->email)
            ->line('**الهاتف:** '.$this->request->phone)
            ->line('**نوع المشروع:** '.$this->request->project_type)
            ->line('**الميزانية:** '.$this->request->budget)
            ->line('**الوصف:**')
            ->line($this->request->description)
            ->action('عرض في الداشبورد', url('/admin/design-requests/'.$this->request->id.'/edit'))
            ->line('شكراً لاستخدامك نظامنا!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'طلب تصميم جديد من '.$this->request->name,
            'body' => 'نوع المشروع: '.$this->request->project_type.' | الميزانية: '.$this->request->budget,
            'actions' => [
                [
                    'name' => 'عرض',
                    'url' => '/admin/design-requests/'.$this->request->id.'/edit',
                ],
            ],
        ];
    }
}
