<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public ContactMessage $message
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('رسالة جديدة من نموذج الاتصال')
            ->greeting('مرحباً!')
            ->line('تم استلام رسالة جديدة من نموذج الاتصال.')
            ->line('**الاسم:** '.$this->message->name)
            ->line('**البريد الإلكتروني:** '.$this->message->email)
            ->line('**الهاتف:** '.$this->message->phone)
            ->line('**الموضوع:** '.$this->message->subject)
            ->line('**الرسالة:**')
            ->line($this->message->message)
            ->action('عرض في الداشبورد', url('/admin/contact-messages/'.$this->message->id.'/edit'))
            ->line('شكراً لاستخدامك نظامنا!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'رسالة جديدة من '.$this->message->name,
            'body' => substr($this->message->message, 0, 100).'...',
            'actions' => [
                [
                    'name' => 'عرض',
                    'url' => '/admin/contact-messages/'.$this->message->id.'/edit',
                ],
            ],
        ];
    }
}
