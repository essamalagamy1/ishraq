<?php

namespace App\Notifications;

use App\Models\Testimonial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTestimonial extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Testimonial $testimonial
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('تقييم جديد من عميل')
            ->greeting('مرحباً!')
            ->line('تم استلام تقييم جديد من عميل.')
            ->line('**الاسم:** '.$this->testimonial->client_name)
            ->line('**الوظيفة:** '.$this->testimonial->client_position)
            ->line('**التقييم:** '.$this->testimonial->rating.' نجوم')
            ->line('**التعليق:**')
            ->line($this->testimonial->content)
            ->action('عرض في الداشبورد', url('/admin/testimonials/'.$this->testimonial->id.'/edit'))
            ->line('شكراً لاستخدامك نظامنا!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'تقييم جديد من '.$this->testimonial->client_name,
            'body' => $this->testimonial->rating.' نجوم - '.substr($this->testimonial->content, 0, 80).'...',
            'actions' => [
                [
                    'name' => 'عرض',
                    'url' => '/admin/testimonials/'.$this->testimonial->id.'/edit',
                ],
            ],
        ];
    }
}
