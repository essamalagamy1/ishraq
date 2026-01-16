<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewJobApplication extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public JobApplication $application
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('طلب توظيف جديد')
            ->greeting('مرحباً!')
            ->line('تم استلام طلب توظيف جديد.')
            ->line('**الاسم:** '.$this->application->name)
            ->line('**البريد الإلكتروني:** '.$this->application->email)
            ->line('**الهاتف:** '.$this->application->phone)
            ->line('**التخصص:** '.$this->application->specialization)
            ->line('**سنوات الخبرة:** '.$this->application->years_of_experience)
            ->action('عرض في الداشبورد', url('/admin/job-applications/'.$this->application->id.'/edit'))
            ->line('شكراً لاستخدامك نظامنا!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'طلب توظيف جديد من '.$this->application->name,
            'body' => 'التخصص: '.$this->application->specialization.' | الخبرة: '.$this->application->years_of_experience.' سنوات',
            'actions' => [
                [
                    'name' => 'عرض',
                    'url' => '/admin/job-applications/'.$this->application->id.'/edit',
                ],
            ],
        ];
    }
}
